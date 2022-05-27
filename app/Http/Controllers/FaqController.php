<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            request()->validate([
                'direction' => ['in:asc,desc'],
                'field' => ['in:question,answer,created_at,updated_at']
            ]);

            $query = Faq::query();

            if (request('search')) {
                $query->where('question', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('answer', 'LIKE', '%' . request('search') . '%');
            }
            if (request()->has(['start_date', 'end_date'])) {
                $query->whereDate('created_at', '>=', request('start_date'))->whereDate('created_at', '<=', request('end_date'));
            }
            if (request()->has(['field', 'direction'])) {
                $query->orderBy(request('field'), request('direction'));
            }
            return Inertia::render('Admin/Faq/Index', [
                'users' => $query->paginate(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        } elseif (auth()->user()->hasRole('Editor')) {
            request()->validate([
                'direction' => ['in:asc,desc'],
                'field' => ['in:question,answer,created_at,updated_at']
            ]);

            $query = Faq::query();

            if (request('search')) {
                $query->where('question', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('answer', 'LIKE', '%' . request('search') . '%');
            }

            if (request()->has(['field', 'direction'])) {
                $query->orderBy(request('field'), request('direction'));
            }
            if (request()->has(['start_date', 'end_date'])) {
                $query->whereDate('created_at', '>=', request('start_date'))->whereDate('created_at', '<=', request('end_date'));
            }
            return Inertia::render('Admin/Faq/Index', [
                'users' => $query->where('created_by', auth()->id())->paginate(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        }
        return abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasAnyRole('Admin', 'Editor')) return abort(403);

        return Inertia::render('Admin/Faq/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasAnyRole('Admin', 'Editor')) return abort(403);

        $val = $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);
        $request['created_by'] = auth()->id();
        try {
            $faq = Faq::create($request->all());
            return redirect()->route('kitchn.faq.index')->with('success', 'Faq created successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('error', 'Not created: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return Inertia::render('Admin/Faq/Edit', ['faq' => $faq]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        if (!auth()->user()->hasAnyRole('Admin', 'Editor')) return abort(403);
        // if (!auth()->user()->hasRole('Admin') || !auth()->user()->hasRole('Editor')) return abort(403);

        $val = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $faq->question = $request['question'];
        $faq->answer = $request['answer'];
        $faq->updated_by = auth()->id();

        $faq->updated_at = now();
        if ($faq->save()) {
            return back()->with('success', 'FAQ updated successfully');
        } else {
            return back()->with('error', 'FAQ did not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        if (!auth()->user()->hasAnyRole('Admin', 'Editor')) return abort(403);

        $faq->delete();
        return redirect()->route('kitchn.faq.index')->with('success', 'Delete Successfull');
    }
}

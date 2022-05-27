<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Knowledgebase;
use Inertia\Inertia;
use App\Models\Section;

class KnowledgeController extends Controller
{
    //
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            request()->validate([
                'direction' => ['in:asc,desc'],
                'field' => ['in:title,author,views,section,created_at,updated_at']
            ]);

            $query = Knowledgebase::query();

            if (request('search')) {
                $query->where('title', 'LIKE', '%' . request('search') . '%');
            }

            if (request()->has(['field', 'direction'])) {
                $query->orderBy(request('field'), request('direction'));
            }
            if (request()->has(['start_date', 'end_date'])) {
                $query->whereDate('created_at', '>=', request('start_date'))->whereDate('created_at', '<=', request('end_date'));
            }
            return Inertia::render('Admin/Knowledge/Index', [
                'users' => $query->with('section')->with('author')->paginate(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        } elseif (auth()->user()->hasRole('Editor')) {
            request()->validate([
                'direction' => ['in:asc,desc'],
                'field' => ['in:title,author,views,section,created_at,updated_at']
            ]);

            $query = Knowledgebase::query();

            if (request('search')) {
                $query->where('title', 'LIKE', '%' . request('search') . '%');
            }

            if (request()->has(['field', 'direction'])) {
                $query->orderBy(request('field'), request('direction'));
            }
            if (request()->has(['start_date', 'end_date'])) {
                $query->whereDate('created_at', '>=', request('start_date'))->whereDate('created_at', '<=', request('end_date'));
            }
            return Inertia::render('Admin/Knowledge/Index', [
                'users' => $query->where('created_by', auth()->id())->with('section')->with('author')->paginate(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        }

        return abort(403);
    }
    public function create()
    {
        if (!auth()->user()->hasAnyRole('Admin', 'Editor')) return abort(403);
        $sections = Section::all();
        return Inertia::render('Admin/Knowledge/Create', ['sections' => $sections, 'filters' => request()->all(['search', 'field', 'direction'])]);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasAnyRole('Admin', 'Editor')) return abort(403);

        $val = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'section' => 'required',
        ]);
        try {
            Knowledgebase::create([
                'title' => $request->get('title'),
                'body' => $request->get('body'),
                'section_id' => $request->get('section'),
                'user_id' => auth()->id(),
                'created_by' => auth()->id(),
                'views' => 0
            ]);
            return back()->with('success', 'Knowledge created successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            // return back()->with('error', 'Not created ');
            return back()->with('error', 'Not created: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ser  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($knowledgebase)
    {
        $knowledgebase = Knowledgebase::where('id', $knowledgebase)->with('section')->first();
        return Inertia::render('Admin/Knowledge/Edit', [
            'knowledge' => $knowledgebase,
            'sections' => Section::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasAnyRole('Admin', 'Editor')) return abort(403);

        $knowledgebase = Knowledgebase::find($id);
        $val = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'section' => 'required'
        ]);
        $knowledgebase->title = $request['title'];
        $knowledgebase->body = $request['body'];
        $knowledgebase->section_id = $request['section'];
        $knowledgebase->updated_by = auth()->id();

        $knowledgebase->updated_at = now();


        if ($knowledgebase->save()) {
            return back()->with('success', 'Knowledge updated successfully');
        } else {
            return back()->with('error', 'Knowledge did not update');
        }
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasAnyRole('Admin', 'Editor')) return abort(403);

        $k = Knowledgebase::find($id);
        $k->delete();
        return redirect()->route('kitchn.knowledge.index')->with('success', 'Delete Successfull');
    }
}

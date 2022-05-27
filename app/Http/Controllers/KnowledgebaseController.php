<?php

namespace App\Http\Controllers;

use App\Models\Knowledgebase;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Traits\PageCount;

class KnowledgebaseController extends Controller
{
    use PageCount;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->counter();

        $query = Knowledgebase::query();
        if (request('search')) {
            $query->where('title', 'LIKE', '%' . request('search') . '%')
                ->orWhere('body', 'LIKE', '%' . request('search') . '%');
        }

        return Inertia::render('Knowledge/Index', [
            'knowledges' => $query->paginate(), 'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->counter();

        $knowledge = Knowledgebase::where('id', $id)->with('section')->with('author')->first();
        $knowledge->views = $knowledge->views + 1;
        $knowledge->save();
        return Inertia::render('Knowledge/Show', ['knowledge' => $knowledge]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

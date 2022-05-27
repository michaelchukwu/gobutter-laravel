<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $val = $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);
        try {
            Section::create([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
            ]);
            return back()->with('success', 'Section created successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            // return back()->with('error', 'Not created ');
            return back()->with('error', 'Not created: ' . $ex->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $knowledgebase = Section::find($id);
        $val = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $knowledgebase->title = $request['title'];
        $knowledgebase->description = $request['description'];
        $knowledgebase->updated_at = now();


        if ($knowledgebase->save()) {
            return back()->with('success', 'Section updated successfully');
        } else {
            return back()->with('error', 'Section did not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $k = Section::find($id);
        $k->delete();
        return back()->with('success', 'Delete Successful');
    }
}

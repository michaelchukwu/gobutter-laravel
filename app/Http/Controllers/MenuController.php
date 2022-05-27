<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:url,location,title,parent,created_at,updated_at']
        ]);

        $query = Menu::query();

        if (request('search')) {
            $query->where('title', 'LIKE', '%' . request('search') . '%')
                ->orWhere('url', 'LIKE', '%' . request('search') . '%')
                ->orWhere('location', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }
        return Inertia::render('Admin/Menus/Index', [
            'users' => $query->paginate(),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Menus/Create');
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
            'url' => 'required',
            'location' => 'nullable',
            'parent' => 'nullable'
        ]);
        try {
            Menu::create([
                'title' => $val['title'],
                'url' => $val['url'],
                'location' => $val['location'],
                'parent' => $val['parent'],
            ]);
            return back()->with('success', 'Menu created successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            // return back()->with('error', 'Not created ');
            return back()->with('error', 'Not created: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)

    {
        return Inertia::render('Admin/Menus/Edit', [
            'user' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $val = $request->validate([
            'title' => 'required',
            'url' => 'required',
            'parent' => 'nullable',
            'location' => 'nullable'
        ]);
        $menu->title = $request['title'];
        $menu->url = $request['url'];
        $menu->parent = $request['parent'];
        $menu->updated_at = now();


        if ($menu->save()) {
            return back()->with('success', 'Menu updated successfully');
        } else {
            return back()->with('error', 'Menu did not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('kitchn.menu.index')->with('success', 'Delete Successfull');
    }
}

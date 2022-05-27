<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::paginate();
        return Inertia::render('Admin/Restaurants/Index',['shops'=>$shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Restaurants/Create');
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
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required'
        ]);
        $request['user_id'] = auth()->id();
        $request['rating'] = 0;
        $request['is_active']= true;
        try{
            Shop::create($request->all());
            return back()->with('success', 'Restaurant created successfully');
        }catch(\Illuminate\Database\QueryException $ex){
            return back()->with('error', 'Not created ');
        }
        // if($shop){
        // }else{
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return Inertia::render('Admin/Restaurants/Edit', ['shop'=>$shop]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $val = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $shop->name = $request['name'];
        $shop->description = $request['description'];
        $shop->is_active = $request['is_active'];
        $shop->updated_at = now();
        if($shop->save()){
            return back()->with('success', 'Restaurant updated successfully');
        }else{
            return back()->with('eroor', 'Restaurant did not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('kitchn.shop.index')->with('success', 'Delete Successfull');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Tag;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate();
        return Inertia::render('Admin/Products/Index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::all();
        return Inertia::render('Admin/Products/Create', ['shops'=>$shops]);

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
            'name'=>'required',
            'sku'=>'required',
            'slug'=>'required|unique:products,slug',
            'img'=>'required|image|max:2084',
            'summary'=>'nullable',
            'description'=>'required',
            'quantity'=>'required',
            'volume'=>'required',
            'price'=>'required',
            'sale_price'=>'required',
            'status'=>'required',
            'featured'=>'required',
            'product_attributes'=>'required|json',
            'shop_id' => 'required',
        ]);
        // if (isset($request['img'])) {
        //     $request->file('img')->move('images');
        //     $filename = $request->file('img')->getClientOriginalName();
        //     $request['img'] = $filename;
        // }
        $ext = $request->file('img')->getClientOriginalExtension();
        $filename = $request['slug'].now().'.'.$ext;
        $request->file('img')->storePubliclyAs('images', $filename, 'public');
        $val['img'] ='/storage/images/'.$filename;
        try{
            $product = Product::create($val);
            return back()->with('success', 'Product created successfully');
        }catch(\Illuminate\Database\QueryException $ex){
            return back()->with('error', 'Not created: '.$ex->getMessage());
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
    public function edit(Product $product)
    {
        $shops = Shop::all();
        return Inertia::render('Admin/Products/Edit', ['product'=>$product, 'shops'=>$shops]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $val = $request->validate([
            'name'=>'required',
            'sku'=>'required',
            'slug'=>'required|unique:products,slug,'.$product->id,
            'img'=>'required',
            'summary'=>'nullable',
            'description'=>'required',
            'quantity'=>'required',
            'volume'=>'required',
            'price'=>'required',
            'sale_price'=>'required',
            'status'=>'required',
            'featured'=>'required',
            'product_attributes'=>'required|json',
            'shop_id' => 'required',
        ]);

        if($product->update($request->all())){
            return back()->with('success', 'Product updated successfully');
        }else{
            return back()->with('eroor', 'Product did not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('kitchn.product.index')->with('success', 'Delete Successfull');
    }
}

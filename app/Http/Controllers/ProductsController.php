<?php

namespace App\Http\Controllers;
use App\sections;

use App\products;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sections =sections::all();
        $products =products::all();

        return view('products.show',compact('sections','products'));
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
        $validated = $request->validate([
            'product_name' => 'required|unique:products|max:255|min:2',
            'description' => 'required|max:255|min:2',
            'section_id' => 'required',

            
        ],[

            'product_name.required'=>'يرجى ادخال اسم القسم',
            'product_name.unique'=>'اسم القسم مسجل مسبقا',
            'description.required'=>'يرجى ادخال اسم القسم',
            'section_id.required'=>'يرجى ادخال اسم القسم',


        ]);



        products::create([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'section_id' => $request->section_id,

             ]);

            //  session()->flash('Add','تم اضافه القسم بنجاح');
             return redirect('/show')->with('success','category has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        // $id = $request->section_id;
        $id = sections::where('section_name' , $request->section_name)->first()->id;

        $products = products::findOrfail($request->id);
        $products->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $id,

        ]);

        return back()->with('success','products has been deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = products::findOrfail($request->id);

        $product->delete();
         return back()->with('info','product has been deleted');
}
}
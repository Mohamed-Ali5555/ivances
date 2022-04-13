<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;

use App\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections =sections::all();
        return view('sections.sections',compact('sections'));
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
            'section_name' => 'required|unique:sections|max:255|min:2',
            'description' => 'required|max:255|min:2',
        ],[

            'section_name.required'=>'يرجى ادخال اسم القسم',
            'section_name.unique'=>'اسم القسم مسجل مسبقا',
            'description.required'=>'يرجى ادخال اسم القسم',


        ]);



        // $input = $request->all();

        // //check the log

        // $b_exists = sections::where('section_name','=',$input['section_name'])->exists();

        // if($b_exists){
        //     session()->flash('Error','خطا القسم مسجل مسبقا');
        //     return redirect('/sections');
        // }else{
             sections::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'created_by' => (Auth::user()->name),
             ]);

            //  session()->flash('Add','تم اضافه القسم بنجاح');
             return redirect('/sections')->with('success','category has been created');
        }

 
       
 
      
     

    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $sections = sections::all();
        // $edit1 = sections::findorfail($id);
        // return view ('sections.sections',['sections'=>$sections,'edit1' => $edit1]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);

        $sections = sections::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('/sections')->with('toast_success','category has been deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        $section = sections::findOrfail($request->id);

        $section->delete();
         return redirect('/sections')->with('info','category has been deleted');


        // $id = $request->id;
        // sections::find($id)->delete();
        // session()->flash('delete','تم حذف القسم بنجاح');
        // return redirect('/sections')->with('info','category has been deleted');


    }
}

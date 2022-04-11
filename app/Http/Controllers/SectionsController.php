<?php

namespace App\Http\Controllers;
use Redirect;

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

             session()->flash('Add','تم اضافه القسم بنجاح');
             return redirect('/sections');
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
        $sections = sections::all();
        $edit = sections::findOrfail($id);

        return view ('sections.edit',['sections' => $sections , 'edit' => $edit ]);  
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
        $section_id = $request->section_id;
        $update = sections::findorfail($section_id);
    
                $update->update([
                    'section_name' => $request->section_name,
                    'description' => $request->description,
                    
                ]);

        //   return redirect('sections/sections', $section_id);
        // return \Redirect::back('sections')->with(['global' => 'ERROR deleted the File!.', 'type' => 'danger']);
        // return \Redirect::back();
        return redirect('/sections');

        //   return redirect('home',$section_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(sections $sections)
    {
        //
    }
}

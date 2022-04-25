<?php

namespace App\Http\Controllers;

use App\sections;
use Illuminate\Support\Facades\Storage;

use App\invoices;
use App\invoices_details;
use App\invoices_attachments;

use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $invoices = invoices::where('id',$id)->first();  
         $attachments = invoices_attachments::where('invoice_id',$id)->get(); 
        $invoices_details = invoices_details::where('id_Invoice',$id)->get(); 
      

        return view ('invoices.invoices_details',compact('invoices' ,'attachments'  , 'invoices_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = invoices_attachments::findOrfail($request-> id_file);//name of input hidden
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);

        return back()->with('success','invoices has been deleted');


        // $invoices = invoice_attachments::findOrFail($request->id_file);
        // $invoices->delete();
        // Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        // session()->flash('delete', 'تم حذف المرفق بنجاح');
        // return back();
    }

    public function get_file( $invoice_number , $file_name){
         $contents =  Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number .'/'.$file_name);

         return response()->download($contents);
    }

    public function open_file($invoice_number,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }
}

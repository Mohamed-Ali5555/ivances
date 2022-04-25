<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Notification;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;

use App\invoices;
use App\sections;
use App\invoices_attachments;
use App\invoices_details;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $invoices = invoices::all();
        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sections  = sections ::all();
        // $categories = category::all();
        return view('invoices.add-invoices',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,

            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Rate_VAT' => $request->Rate_VAT,
            'Value_VAT' => $request->Value_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
            'status' =>'not paied',
            'value_status' => 2,
         ]);


         $invoice_id = invoices::latest()->first()->id;  // this code give invoices id to invoices details
         invoices_details::create([
             'id_Invoice'=>$invoice_id,
             'invoice_number' => $request->invoice_number,
             'product' => $request->product,
             'Section' => $request->Section,
             'note' => $request->note,
             'status' =>'not paied',
             'value_status' => 2,
             'user' =>(Auth::user()->name)

         ]);

         if ($request->hasFile('pic')){
            

             $invoice_id = Invoices::latest()->first()->id;
             $image = $request->file('pic');
             $file_name = $image->getClientOriginalName();
             $invoice_number = $request->invoice_number;

             $attachments = new invoices_attachments();
             $attachments->file_name = $file_name;
             $attachments->invoice_number = $invoice_number;
             $attachments->invoice_id = $invoice_id;
             $attachments->created_by = Auth::user()->name;
              $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
         }
        //  section notification (send mail)
        $user = User::first();
        Notification::send($user, new InvoicePaid($invoice_id));
        return back()->with('success','invoices has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $sections = sections::all();
        return view('invoices.edit_invoices',compact('invoices','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoice_id = $request->invoice_id;
               $invoices = invoices::findorfail($invoice_id);
    

           
        $invoices->update([
            // 'colom in page edit'=>$request->name in edit page name of input 
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'due_date' => $request->Due_date,
            'product' => $request->product,
            'Discount' => $request->Discount,
            'Amount_collection' =>$request->Amount_collection,
            'Amount_commission' => $request->Amount_Commission,
            'section_id' => $request->Section,
            'Rate_VAT' => $request->Rate_VAT,
            'Value_VAT' => $request->Value_VAT,
            'Total' => $request->Total,
            'note' => $request->note,



            // 'invoice_number' => $request->invoice_number,
            // 'invoice_Date' => $request->invoice_Date,
            // 'Due_date' => $request->Due_date,
            // 'product' => $request->product,

            // 'section_id' => $request->Section,
            // 'Amount_collection' => $request->Amount_collection,
            // 'Amount_Commission' => $request->Amount_Commission,
            // 'Discount' => $request->Discount,
            // 'Rate_VAT' => $request->Rate_VAT,
            // 'Value_VAT' => $request->Value_VAT,
            // 'Total' => $request->Total,
           

            'note' => $request->note,

        ]);
        return back()->with('success','invoices has been update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->invoice_id;
        $invoices = invoices::findOrfail($request->invoice_id);

        $Deletes = invoices_attachments::where('invoice_id',$id)->first();


        $id_page = $request->id_page;
         if(!$id_page == 2)  {  //archeve methode  you can make this in new function
        if(!empty( $Deletes->invoice_number)){
        //    Storage::disk('public_uploads')->deleteDirectory($Deletes->invoice_number.'/'.$request->file_name); delete file not folder

        Storage::disk('public_uploads')->deleteDirectory($Deletes->invoice_number);  //delete folder and file

        }

         $invoices->forceDelete();
         return back()->with('info','invoices has been deleted from databaise');

    }else{
            $invoices->delete();
            return back()->with('info','product has been added to archeve');
        }

        //$Deletes = invoices_attachments::findOrfail($id);
        //  $Deletes = invoices_attachments::where('invoice_id',$id)->first();


        // if(File::exists(public_path('Attachments/.$invoice_number'. $Deletes->file_name))){
        //     File::delete(public_path('Attachments'  . $Deletes->file_name));
        // }else{
        //     dd('File does not exists.');
        // }


    }







    public function getproducts( $id){
        $products = DB::table('products')->where('section_id',$id)->pluck('product_name','id');//section_id = id =>that is come from rote when you pres on it and pluck product_name with id 
        return json_encode($products);
    }


    public function change_status( $id){
        $invoices = invoices::where('id',$id)->first();
        $sections = sections::all();
        return view('invoices.status_update',compact('invoices','sections'));
  
    }
     
    public function update_status(Request $request, $id){
        $invoices = invoices::findOrfail($id);
        if($request->status === 'paid'){
            $invoices->update([

           
            'value_status' => 1,
            'status'=>$request->status,
            'payment_date'=>$request->payment_date,
            ]);

            //then create new row in invoices details to show the changes
            invoices_details::create([
                'id_Invoice'=>$request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'note' => $request->note,
                'status' =>' paied',
                'value_status' => 1,
                'payment_date'=>$request->payment_date,
                'user' =>(Auth::user()->name)
   
            ]);

        }else{
            $invoices->update([
                'value_status' => 3,
                'status'=>$request->status,
                'payment_date'=>$request->payment_date,
                ]);

                invoices_details::create([
                    'id_Invoice'=>$request->invoice_id,
                    'invoice_number' => $request->invoice_number,
                    'product' => $request->product,
                    'Section' => $request->Section,
                    'note' => $request->note,
                    'status' =>'paied part',
                    'value_status' => 3,
                    'payment_date'=>$request->payment_date,
                    'user' =>(Auth::user()->name)
       
                ]);
        }

        return back()->with('info','status has been updated');

    }

// status condion
public function paid_status(){
   $invoices = invoices::where('value_status',1)->get();
   return view('invoices.paid_invoices',compact('invoices'));
}

public function unpaid_status(){
    $invoices = invoices::where('value_status',2)->get();
    return view('invoices.partpaid_invoices',compact('invoices'));
}

public function paidpart_status(){
    $invoices = invoices::where('value_status',3)->get();
    return view('invoices.unpaid_invoices',compact('invoices'));
}
// print invoices 
public function print_invoices($id){
    $invoices = invoices::where('id',$id)->first();
        return view('invoices.print_invoices',compact('invoices'));

}

// exeil export 
public function export() 
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
}

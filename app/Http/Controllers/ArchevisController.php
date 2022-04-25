<?php

namespace App\Http\Controllers;
use App\invoices;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Http\Request;

class ArchevisController extends Controller
{
    public function index(){
        $invoices=invoices::onlyTrashed()->get();  // there we write onlytrached to get invoices that has softdelets value ==المارشفه
  
  return view('invoices.archevis_invoices' , compact('invoices'));
    }


    // this is code return to invoices table from archeve 
    public function update(Request $request){
    $id = $request->invoice_id;
    $flight = invoices::withTrashed()->where('id',$id)->restore();
    return redirect('/invoices');
    }

    public function destroy(Request $request)
    {
        $id=$request->invoice_id;
        $invoices = invoices::withTrashed($request->invoice_id);

        // $invoices = invoices::withTrashed()->where('id',$id)->first();

        $invoices->forceDelete();
        return back()->with('info','archives has been added to for ever');
    }

}

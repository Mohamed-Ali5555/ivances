<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;

class Invoices_reportController extends Controller
{
    public function index(){

        return view('reports.invoices_report');
           
       }
   



       public function Search_invoices(Request $request){
   
       $rdio = $request->rdio;  //type input radio two input
   
   
    // في حالة البحث بنوع الفاتورة
       
       if ($rdio == 1) {   //value of input 1 
          
          
    // في حالة عدم تحديد تاريخ
           if ($request->invoice_checked1 && $request->start_at =='' && $request->end_at =='') {
               
              $invoices = invoices::select('*')->where('status','=',$request->invoice_checked1)->get();
              $invoice_checked1 = $request->invoice_checked1;
              return view('reports.invoices_report',compact('invoice_checked1'))->withDetails($invoices);
           }
           
           // في حالة تحديد تاريخ استحقاق
           else {
              
             $start_at = date($request->start_at);
             $end_at = date($request->end_at);
             $invoice_checked1 = $request->invoice_checked1;
             
             $invoices = invoices::whereBetween('invoice_date',[$start_at,$end_at])->where('status','=',$request->invoice_checked1)->get();
             return view('reports.invoices_report',compact('invoice_checked1','start_at','end_at'))->withDetails($invoices);
             
           }
   
    
           
       } 
       
   //====================================================================
       
   // في البحث برقم الفاتورة
       else {
           
           $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
           return view('reports.invoices_report')->withDetails($invoices);
           
       }
   
       
        
       }
}

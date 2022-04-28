<?php

namespace App\Http\Controllers;
use App\sections;
use App\invoices;
use Illuminate\Http\Request;

class Customers_reportController extends Controller
{
    public function index(){

        $sections = sections::all();
        return view('reports.customers_report',compact('sections'));
          
      }


    //   public function Search_customers(Request $request){
    //     // في حالة البحث بدون التاريخ
              
    //          if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {
        
               
    //           $invoices = invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
    //           $sections = sections::all();
    //            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
    //          }
        
    //       // في حالة البحث بتاريخ
             
    //          else {
               
    //            $start_at = date($request->start_at);
    //            $end_at = date($request->end_at);
        
    //           $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
    //            $sections = sections::all();
    //            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
    //          }
             
    //         }

    public function Search_customers(Request $request)
    {
        //in case search when histroy empty 
        if($request->Section && $request->product && $request->start_at =='' && $request->end_at == '')
        {
            $invoices = invoices::select('*')->where('section_id' , '=' ,$request->Section)->where('product' ,'=',$request->product)->get();
            $sections = sections::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
        }else{
            //in case there history 
             $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            

            $invoices = invoices::whereBetween('invoice_date',[$start_at,$end_at])->where('section_id' , '=',$request->Section)->where('product','=',$request->product)->get();
            $sections = sections::all();
                       return view('reports.customers_report',compact('sections'))->withDetails($invoices);
         }

        
    //   // for testing 
    //   $invoices = invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->where('start_at','=',$request->start_at)->where('end_at','=',$request->end_at)->get();
    //   $sections = sections::all();
    //    return view('reports.customers_report',compact('sections'))->withDetails($invoices);
    }






}

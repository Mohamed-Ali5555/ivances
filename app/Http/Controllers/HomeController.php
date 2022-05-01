<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $count_all = invoices::count();
        $count_invoices2 = invoices::where('value_status',2)->count();

////////////////

        if($count_invoices2 != 0)     
        $nspa_invoices2 = $count_invoices2/ $count_all*100;
        else     
        $nspa_invoices2 = 0;


      


    

        /////////////////////////


        $count_invoices3 = invoices::where('value_status',3)->count();
        ///////////////////////////
        if($count_invoices3 != 0)     
        $nspa_invoices3 = $count_invoices3/ $count_all*100;
        else     
        $nspa_invoices3 = 0;
/////////////////////////////////

        $count_invoices1 = invoices::where('value_status',1)->count();
        ////////////////
        if($count_invoices1 != 0)     
        $nspa_invoices1 = $count_invoices1/ $count_all*100;
        else     
        $nspa_invoices1 = 0;

///////////////////////

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$nspa_invoices2]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$nspa_invoices1]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$nspa_invoices3]
                ],


            ])
            ->options([]);



            $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
                    'data' => [$nspa_invoices2, $nspa_invoices1,$nspa_invoices3]
                ]
            ])
            ->options([]);

        return view('home', compact('chartjs','chartjs_2'));
    }
}

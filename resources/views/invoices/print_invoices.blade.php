@extends('layouts.master')
@section('css')
<style>
{{-- this coe for removing the button print when we pres print --}}
@media print{
    #print_div{
        display:none;
    }
}

</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ print
                    invoices</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print"> {{-- //this id we use in function printDiv --}}
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">Invoice</h1>
                            <div class="billed-from">
                                <h6>BootstrapDash, Inc.</h6>
                                <p>201 Something St., Something Town, YT 242, Country 6546<br>
                                    Tel No: 324 445-4544<br>
                                    Email: youremail@companyname.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">Billed To</label>
                                <div class="billed-to">
                                    <h6>Juan Dela Cruz</h6>
                                    <p>4033 Patterson Road, Staten Island, NY 10301<br>
                                        Tel No: 324 445-4544<br>
                                        Email: youremail@companyname.com</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">Invoice Information</label>
                                <p class="invoice-info-row"><span>?????? ????????????????</span>
                                    <span>{{ $invoices->invoice_number }}</span>
                                </p>
                                <p class="invoice-info-row"><span>?????????? ??????????????</span>
                                    <span>{{ $invoices->invoice_Date }}</span>
                                </p>
                                <p class="invoice-info-row"><span> ?????????? ??????????????????:</span> <span>{{ $invoices->due_date }}
                                    </span></p>
                                <p class="invoice-info-row"><span>??????????:</span> <span>
                                        {{ $invoices->section->section_name }} </span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-40p">????????????</th>
                                        <th class="tx-right">???????? ??????????????</th>
                                        <th class="tx-right">???????? ??????????????</th>
                                        <th class="tx-right">????????????????</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="tx-right">{{ $invoices->product }}</td>
                                        <td class="tx-right">{{ $invoices->Amount_collection }}</td>
                                        <td class="tx-right">{{ $invoices->Amount_commission }}</td>
                                      
                                      
                                      @php
                                      $total1 = $invoices->Amount_commission + $invoices->Amount_collection;
                                      @endphp
                                        <td class="tx-right">{{number_format($total1 , 2)  }}</td>


                                    </tr>



                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="6">
                                            <div class="invoice-notes">

                                            </div><!-- invoice-notes -->
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="tx-right">????????????????</td>
                                        <td class="tx-right" colspan="2">{{number_format($total1 ,2)  }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">???????? ??????????????</td>
                                        <td class="tx-right" colspan="2">{{ $invoices->rate_vat }}</td>
                                    </tr>

                                    <tr>
                                        <td class="tx-right">???????? ?????????? </td>
                                        <td class="tx-right" colspan="2">{{ number_format($invoices->discount , 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">???????????????? ???????? ?????????? </td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{number_format($invoices->total , 2)  }}</h4>
                                        </td>
                                    </tr>

                                       <tr>
                                        <td class="tx-right"> enginner </td>
                                        <td class="tx-right" colspan="2">{{ Auth::user()->name }}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                       
                        <button  class="btn btn-danger float-left mt-3 mr-2" onclick="printDiv()" id="print_div">
                            <i class="mdi mdi-printer ml-1" ></i>Print
                        </button>
                      
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    {{-- script print  --}}
    <script>

     function printDiv(){
         var printContents = document.getElementById('print').innerHTML;
         var originalContents = document.body.innerHTML;
         document.body.innerHTML = printContents;
         window.print();
         document.body.innerHTML = originalContents;
         location.reload();
     }
    
    
    </script>
@endsection

@extends('layouts.master')
@section('title')
    الفواتير
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمةالفواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">



        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Bordered Table</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    @can('اضافة فاتورة')
                        <a href="{{ route('invoices.create') }}" class="btn btn-success">add new invoices</a>
                    @endcan
                    @can('تصدير EXCEL')
                        <a class="modal-effect btn btn-sm btn-primary" href="{{ url('export_invoices') }}"
                            style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتوره</th>
                                    <th class="border-bottom-0">تاريخ الفاتوره</th>
                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                    <th class="border-bottom-0"> المنتج</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0"> الخصم</th>
                                    <th class="border-bottom-0"> نسبه الخصم</th>
                                    <th class="border-bottom-0"> قيمه الضريبه</th>
                                    <th class="border-bottom-0">الاجمالي</th>
                                    <th class="border-bottom-0">الحاله</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($invoices as $invoice)
                                    <?php $i++; ?>

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $invoice->invoice_number }} </td>
                                        <td>{{ $invoice->invoice_Date }} </td>
                                        <td>{{ $invoice->due_date }} </td>
                                        <td>{{ $invoice->product }} </td>
                                        {{-- <td>{{ $invoice->section->section_name }} </td> --}}
                                        <td>
                                            <a href="{{ route('invoices.invoices_details', $invoice->id) }}"
                                                class="btn "
                                                style="margin-top:-5px">{{ $invoice->section->section_name }}</a>
                                        </td>
                                        <td>{{ $invoice->discount }} </td>

                                        <td>{{ $invoice->rate_vat }} </td>
                                        <td>{{ $invoice->value_vat }} </td>
                                        <td>{{ $invoice->total }} </td>
                                        <td>

                                            @if ($invoice->value_status == 1)
                                                <span class="text-success">{{ $invoice->status }}</span>
                                            @elseif($invoice->value_status == 2)
                                                <span class="text-danger">{{ $invoice->status }}</span>
                                            @else
                                                <span class="text-warning">{{ $invoice->status }}</span>
                                            @endif

                                        </td>
                                        <td>{{ $invoice->note }} </td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">


                                                    @can('تعديل الفاتورة')
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.edit_invoices', $invoice->id) }}">تعديل
                                                            الفاتورة</a>
                                                    @endcan


                                                    @can('حذف الفاتورة')
                                                        <a class="dropdown-item" href="#"
                                                            data-invoice_id="{{ $invoice->id }}" data-toggle="modal"
                                                            data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>
                                                            &nbsp;&nbsp;delete</a>
                                                    @endcan


                                                    @can('تغير حالة الدفع')
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.change_status', $invoice->id) }}"><i
                                                                class=" text-success fas
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                            حالة
                                                            الدفع</a>
                                                    @endcan
                                                    @can('طباعةالفاتورة')
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.print_invoices', $invoice->id) }}"><i
                                                                class=" text-success fas
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                            طباعه الفاتورة
                                                            الدفع</a>
                                                    @endcan

                                                    @can('ارشفة الفاتورة')
                                                        <a class="dropdown-item" href="#"
                                                            data-invoice_id="{{ $invoice->id }}" data-toggle="modal"
                                                            data-target="#archeve_invoices">
                                                            <i class="text-warning fas fa-exchange-alt"></i>
                                                            &nbsp;&nbsp;add to archeve</a>
                                                    @endcan


                                                </div>
                                            </div>


                                        </td>


                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->

        <!--div-->

    </div>
    <!-- /row -->
    <!-- delete -->
    <div class="modal" id="delete_invoice">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('invoices.destroy') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="text" name="invoice_id" id="invoice_id" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- archeve invoices -->
    <div class="modal" id="archeve_invoices">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('invoices.destroy') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الارشفه ؟</p><br>
                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
                        <input type="hidden" name="id_page" id="id_page" value="2">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <!-- End Basic modal delete -->

    <!-- /row -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>



    {{-- JAVASCRIPT DELETE --}}
    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)

            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);

        })
    </script>
    {{-- END JAVASCRIPT DELETE --}}

    {{-- JAVASCRIPT archive --}}
    <script>
        $('#archeve_invoices').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)

            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);

        })
    </script>
    {{-- END JAVASCRIPT archive --}}
@endsection

@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Basic Style2 Tabs
                    </div>
                    <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab"> معلومات
                                                    الفاتوره</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a>
                                            </li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="example1" class="table key-buttons text-md-nowrap">

                                                        <tbody>


                                                            <tr>
                                                                <th class="border-bottom-0">رقم الفاتوره</th>
                                                                <td>{{ $invoices->invoice_number }} </td>

                                                                <th class="border-bottom-0">تاريخ الفاتوره</th>

                                                                <td>{{ $invoices->invoice_Date }} </td>

                                                                <th class="border-bottom-0">تاريخ الاستحقاق</th>

                                                                <td>{{ $invoices->due_date }} </td>

                                                                <th class="border-bottom-0">القسم</th>

                                                                <td>{{ $invoices->section->section_name }} </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="border-bottom-0"> المنتج</th>

                                                                <td>{{ $invoices->product }} </td>


                                                                <th class="border-bottom-0"> مبلغ التحصيل</th>

                                                                <td>{{ $invoices->Amount_collection }} </td>

                                                                <th class="border-bottom-0"> مبلغ العموله</th>

                                                                <td>{{ $invoices->Amount_commission }} </td>

                                                                <th class="border-bottom-0"> الخصم</th>

                                                                <td>{{ $invoices->discount }} </td>

                                                            </tr>

                                                            <tr>
                                                                <th class="border-bottom-0"> نسبه الضريبه</th>

                                                                <td>{{ $invoices->rate_vat }} </td>


                                                                <th class="border-bottom-0"> قيمه الضريبه</th>

                                                                <td>{{ $invoices->value_vat }} </td>

                                                                <th class="border-bottom-0"> الاجمالي مع الضريبه</th>

                                                                <td>{{ $invoices->total }} </td>

                                                                <th class="border-bottom-0"> الحاله</th>

                                                                <td>

                                                                    @if ($invoices->value_status === 1)
                                                                        <span
                                                                            class="text-success">{{ $invoices->status }}</span>
                                                                    @elseif($invoices->value_status === 2)
                                                                        <span
                                                                            class="text-danger">{{ $invoices->status }}</span>
                                                                    @else
                                                                        <span
                                                                            class="text-warning">{{ $invoices->status }}</span>
                                                                    @endif

                                                                </td>

                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab5">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th class="border-bottom-0">#</th>
                                                                <th class="border-bottom-0">رقم الفاتوره</th>

                                                                <th class="border-bottom-0"> نوع المنتج </th>
                                                                <th class="border-bottom-0">القسم</th>
                                                                <th class="border-bottom-0">حاله الدفع</th>

                                                                <th class="border-bottom-0">تاريخ الدفع</th>
                                                                <th class="border-bottom-0">ملاحظات</th>

                                                                <th class="border-bottom-0">تاريخ الاضافه</th>


                                                                <th class="border-bottom-0"> المستخدم</th>



                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($invoices_details as $invoices_detail)
                                                                <?php $i++; ?>

                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $invoices_detail->invoice_number }} </td>
                                                                    <td>{{ $invoices_detail->product }} </td>
                                                                    <td>{{ $invoices->section->section_name }}
                                                                    </td>
                                                                    <td>

                                                                        @if ($invoices_detail->value_status == 1)
                                                                            <span
                                                                                class="text-success">{{ $invoices_detail->status }}
                                                                            </span>
                                                                        @elseif($invoices_detail->value_status == 2)
                                                                            <span
                                                                                class="text-danger">{{ $invoices_detail->status }}
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="text-warning">{{ $invoices_detail->status }}
                                                                            </span>
                                                                        @endif

                                                                    </td>
                                                                    <td>{{ $invoices_detail->payment_date }} </td>
                                                                    <td>{{ $invoices_detail->note }} </td>
                                                                    <td>{{ $invoices_detail->created_at }} </td>
                                                                    <td>{{ $invoices_detail->user }} </td>




                                                                </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            {{-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| --}}

                                            <div class="card-body">
                                                <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                <h5 class="card-title">اضافة مرفقات</h5>
                                                <form method="post" action="{{route('Invoices_details.store')}}"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            name="file_name" required>
                                                        <input type="hidden" id="customFile" name="invoice_number"
                                                            value="{{ $invoices->invoice_number }}">
                                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                                            value="{{ $invoices->id }}">
                                                        <label class="custom-file-label" for="customFile">حدد
                                                            المرفق</label>
                                                    </div><br><br>
                                                    <button type="submit" class="btn btn-primary btn-sm "
                                                        name="uploadedFile">تاكيد</button>
                                                </form>
                                            </div>


                                            {{-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||| --}}

                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th class="border-bottom-0">#</th>
                                                                <th class="border-bottom-0"> اسم الملف</th>

                                                                <th class="border-bottom-0"> قام بالاضافه </th>

                                                                <th class="border-bottom-0">تاريخ الاضافه</th>
                                                                <th class="border-bottom-0">العمليات</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($attachments as $attachment)
                                                                <?php $i++; ?>

                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $attachment->file_name }} </td>
                                                                    <td>{{ $attachment->created_by }} </td>
                                                                    <td>{{ $attachment->created_at }}</td>


                                                                    <td colspan="2">

                                                                        <a class="btn btn-outline-success btn-sm"
                                                                            href="{{ url('View_file') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-eye"></i>&nbsp;
                                                                            show</a>



                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            download</a>

                                                                        {{-- @can('حذف المرفق') --}}
                                                                        <a class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-file_name="{{ $attachment->file_name }}"
                                                                            data-invoice_number="{{ $attachment->invoice_number }}"
                                                                            data-id_file="{{ $attachment->id }}"
                                                                            data-target="#delete_file">حذف
                                                                        </a>
                                                                        {{-- @endcan --}}

                                                                    </td>




                                                                </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!---Prism Pre code-->

                            <!---Prism Pre code-->
                        </div>

                    </div>
                    <!-- row closed -->

                    <!-- delete -->
                    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('delete_file') }}" method="post">

                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <p class="text-center">
                                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                                        </p>

                                        <input type="hidden" name="id_file" id="id_file" value="">
                                        <input type="hidden" name="file_name" id="file_name" value="">
                                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                        <button type="submit" class="btn btn-danger">تاكيد</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container closed -->
            </div>
            <!-- main-content closed -->
        @endsection
        @section('js')
            <script>
                $('#delete_file').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget)
                    var id_file = button.data('id_file')
                    var file_name = button.data('file_name')
                    var invoice_number = button.data('invoice_number')
                    var modal = $(this)

                    modal.find('.modal-body #id_file').val(id_file);
                    modal.find('.modal-body #file_name').val(file_name);
                    modal.find('.modal-body #invoice_number').val(invoice_number);
                })
            </script>
        @endsection

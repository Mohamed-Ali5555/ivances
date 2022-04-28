@extends('layouts.master')
@section('title')
    الافسام
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
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    {{-- ########################3#33# --}}
    {{-- errors code --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- ############################3 --}}
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            @can('اضافة منتج')
                                <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                    data-toggle="modal" href="#modaldemo8">add product</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم المنتج </th>

                                    <th class="border-bottom-0">اسم القسم </th>
                                    <th class="border-bottom-0"> ملاحظات</th>
                                    <th class="border-bottom-0">العمليات </th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($products as $product)
                                    <?php $i++; ?>

                                    <tr>

                                        <td>{{ $i }}</td>
                                        <td> {{ $product->product_name }}</td>
                                        <td> {{ $product->section->section_name }}</td>

                                        <td> {{ $product->description }}</td>
                                        <td> {{ $product->product_name }}</td>


                                        {{-- <td>

                                            <form action="{{ route('sections.destroy', $section->id) }}"
                                                enctype="multipart/form-data" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $section->id }}" name="section_id">
                                                <button class="btn btn-sm btn-danger " id="show_confirm" type="submit"> <i
                                                        class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td> --}}


                                        <td>
                                            @can('تعديل منتج')
                                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                    data-toggle="modal"
                                                    data-section_name="{{ $product->section->section_name }}"
                                                    data-product_name="{{ $product->product_name }}"
                                                    data-id="{{ $product->id }}"
                                                    data-description="{{ $product->description }}" href="#modaldemo2">
                                                    <i class="las la-pen"></i></a>
                                            @endcan


                                            {{-- <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{ $x->id }}"
                                                        data-section_name="{{ $x->section_name }}"
                                                       data-description="{{ $x->description }}" 
                                                       data-toggle="modal" href="#exampleModal2"
                                                       title="تعديل"><i class="las la-pen"></i></a> --}}

                                            @can('حذف منتج')
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-id="{{ $product->id }}"
                                                    data-product_name="{{ $product->product_name }}" data-toggle="modal"
                                                    href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>
                                            @endcan
                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ADD NEW PRODUCT --}}
        <!-- Basic modal -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">اضافه قسم </h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">اسم المنتج </label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    aria-describedby="emailHelp">

                            </div>


                            {{-- ++++++++++++++++++++++++++++++++++++++++++ --}}

                            <div class="form-group">
                                <label>section_id</label>
                                <br>
                                <select class="form-control" name="section_id">
                                    <option readonly>---choose--</option>
                                    <!-- <option  value="0">main category</option> -->
                                    @if ($sections->count() > 0)
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                        @endforeach
                                    @else
                                        <option disabled readonly>there is not category here</option>
                                    @endif

                                </select>
                            </div>
                            {{-- +++++++++++++++++++++++++++++++++++++++++++++ --}}





                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">ملاحظات </label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>




                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">تاكيد</button>
                                <button class="btn btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
        {{-- END NEW PRODUCT --}}
    </div>
    <!-- Basic EDIT modal -->
    <div class="modal fade" id="modaldemo2" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافه قسم </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                    <form action="show/update" enctype="multipart/form-data" method="post">
                        {{ method_field('patch') }}


                        {{ csrf_field() }}



                        <div class="form-group">

                            <input type="hidden" name="id" id="id" value="">


                            <label for="exampleInputEmail1">اسم القسم </label>
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                aria-describedby="emailHelp">

                        </div>

                        {{-- +++++++++++++++++++++++ --}}
                        <div class="form-group">
                            <label>parent</label>

                            <br>


                            <select class="form-control" name="section_name" id="section_name">

                                @foreach ($sections as $section)
                                    <option {{ $section->id }}>{{ $section->section_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        {{-- +++++++++=+++++++++++++ --}}

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">ملاحظات </label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>


                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">تاكيد</button>
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Basic modal EDIT -->

    <!-- start Basic modal delete -->
    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="show/destroy" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="text" name="id" id="id" value="">
                        <input class="form-control" name="product_name" id="product_name" type="text" readonly>
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


    <!-- End Basic modal delete -->
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
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    {{-- JAVASCRIPT DELETE --}}
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
        })
    </script>
    {{-- END JAVASCRIPT DELETE --}}


    {{-- JAVASCRIPT EDIT --}}
    <script>
        $('#modaldemo2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('product_name')
            var description = button.data('description')
            var section_name = button.data('section_name')
            var id = button.data('id')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #id').val(id);

        })
    </script>
    {{-- END JAVASCRIPT EDIT --}}
@endsection

@extends('admin.index')

@section('content')
    @push('css')
        <link href="{{ asset('dashboard/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dashboard/libs/summernote/summernote.min.css') }}" rel="stylesheet" type="text/css" />

        <style>
            a,
            a:hover {
                color: white;
            }

            .table-bordered {
                margin-left: 300px;
                width: 1000px;
             
            }
            .card-title{
                margin-left: 300
            }
          
    

          
        </style>
    @endpush

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title">
                            <h4 class="mb-0 font-size-18">عرض تقارير</h4>
                            <ol class="breadcrumb">
                                {{-- {{ Breadcrumbs::render('service.edit', $service) }} --}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Start Page-content-Wrapper -->
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">عرض تفاصيل الفاتورة</h4>
                                @include('admin.layouts.message')

                                <form method="POST" action="{{ route('save_invoice') }}">
                                    @csrf
                                    <table id="invoices-table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>اسم الصنف</th>
                                                <th>العدد</th>
                                                <th>السعر</th>
                                                <th>المجموع</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($Invoices_name); $i++)
                                                <tr>
                                                    <td>{{$Invoices_name[$i]}}</td>
                                                    <td>{{$Invoices_quantity[$i]}}</td>
                                                    <td>{{$Invoices_price[$i]}}</td>
                                                    <td>{{$Invoices_subtotal[$i]}}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>

                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- End Col -->
                </div>
                <!-- end row -->

            </div>
            <!-- End Page-content-Wrapper -->

        </div>
        <!-- Container-fluid -->
    </div>
    <!-- End Page-content -->

    @push('js')
        <!-- jquery-validation -->
        <script src="{{ asset('dashboard/libs/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('dashboard/libs/jquery-validation/additional-methods.min.js') }}"></script>
        <script src="{{ asset('dashboard/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('dashboard/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ asset('dashboard/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('dashboard/libs/parsleyjs/parsley.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"></script>
        <script src="{{ asset('dashboard/libs/summernote/summernote.min.js') }}"></script>

        <!-- validation init -->
        <script src="{{ asset('dashboard/js/pages/form-validation.init.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

        <!-- Upload image -->
        <script src="{{ asset('dashboard/admin/js/service/upload_image.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('dashboard/js/app.js') }}"></script>

       
@endsection

@extends('admin.index')

@section('content')
    @push('css')
        <!-- DataTables -->
        <link href="{{asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
              rel="stylesheet" type="text/css" />
        <link href="{{asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
              rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{asset('dashboard/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
              rel="stylesheet"
              type="text/css" />
        <!-- Plugin Css -->

        <style>
            td .mt-3 .form-label{
                width: 50px!important;
                height: 20px!important;
            }

            input[switch]+label:after {
                height: 16px!important;
                width: 16px!important;
            }

            input[switch]+label:before {
                height: 16px!important;
                width: 16px!important;
            }

            table.dataTable thead .sorting:before,
            table.dataTable thead .sorting_asc:before,
            table.dataTable thead .sorting_asc_disabled:before,
            table.dataTable thead .sorting_desc:before,
            table.dataTable thead .sorting_desc_disabled:before  {
                left: auto;
                right: 0.5rem;
                content: "\F0360";
                font-family: "Material Design Icons";
                font-size: 1rem;
                top: 9px;
            }

            table.dataTable thead .sorting:after,
            table.dataTable thead .sorting_asc:after,
            table.dataTable thead .sorting_asc_disabled:after,
            table.dataTable thead .sorting_desc:after,
            table.dataTable thead .sorting_desc_disabled:after {
                left: auto;
                right: 0.5em;
                content: "\F035D";
                font-family: "Material Design Icons";
                top: 15px;
                font-size: 1rem;
            }

            #delete{
                cursor: pointer;
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
                                <h4 class="mb-0 font-size-18">{{__('Services List')}}</h4>
                                <ol class="breadcrumb">
                                    {{ Breadcrumbs::render('services.service_list') }}
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Start Page-content-Wrapper -->
                <div class="page-content-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">{{__('Services List')}}</h4>
                                    <p class="card-title-desc">
                                        <a href="{{route('services.create')}}" class="btn btn-success">{{__('Create Service')}}</a>
                                    </p>

                                    <table id="datatable"
                                           class="table table-striped table-bordered nowrap"
                                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="desktop">{{_('Title')}}</th>
                                            {{-- <th scope="col" class="desktop">{{_('Description')}}</th> --}}
                                            {{-- <th scope="col" class="desktop">{{_('Price')}}</th> --}}
                                            <th scope="col" class="desktop">{{_('Image')}}</th>
                                            <th scope="col" class="desktop">{{_('Action')}}</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
                <!-- End Page-content -->

            </div>
            <!-- Container-Fluid -->
        </div>
        <!-- End Page-content-wrapper -->
        <div id="table-url" data-url="{{route('services.service_list')}}"></div>
        <div id="table-url" data-url="{{route('services.delete_service')}}"></div>

    @push('js')
        <!--  datatable js -->
            <script src="{{asset('dashboard/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
            <!-- Buttons examples -->
            <script src="{{asset('dashboard/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
            <script src="{{asset('dashboard/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
            <script src="{{asset('dashboard/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
            <script src="{{asset('dashboard/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
            <script src="{{asset('dashboard/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
            <!-- Responsive examples -->
            <script src="{{asset('dashboard/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
            <script src="{{asset('dashboard/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
            <!-- Datatable init js -->
            <script src="{{asset('dashboard/js/pages/datatables.init.js')}}"></script>
            <!-- List js -->
            <script src="{{asset('dashboard/admin/js/service/list.js')}}"></script>
            <!-- Delete js -->
            <script src="{{asset('dashboard/admin/js/service/delete.js')}}"></script>
            <!-- App js -->
            <script src="{{asset('dashboard/js/app.js')}}"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/1.3.1/js/toastr.min.js"></script>

            <script>
                $(document).ready(function() {
                    toastr.options.timeOut = 10000;
                    @if (Session::has('error'))
                        toastr.error('{{ Session::get('error') }}');
                    @elseif(Session::has('success'))
                        toastr.success('{{ Session::get('success') }}');
                    @endif
                });
        
            </script>

            


    @endpush
@endsection

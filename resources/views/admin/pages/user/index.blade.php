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
    @endpush
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <div class="page-title">
                                <h4 class="mb-0 font-size-18">{{ __('عرض الموظفين') }}</h4>
                                <ol class="breadcrumb">
                                    {{-- {{ Breadcrumbs::render('user.create') }} --}}
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Page-content-Wrapper -->
                <div class="page-content-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    {{-- <h4 class="card-title">{{__('Users List')}}</h4> --}}
                                    <p class="card-title-desc">
                                        {{-- <a href="{{route('users.create')}}" class="btn btn-success">{{__('Create User')}}</a> --}}
                                    </p>
                                    <!-- End Row -->
                                    <table id="datatable"
                                           class="table table-striped table-bordered nowrap"
                                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="desktop">{{_('الاسم')}}</th>
                                            <th scope="col" class="desktop">{{_('الوظيفة')}}</th>
                                            <th scope="col" class="desktop">{{_('الإيميل')}}</th>
                                            <th scope="col" class="desktop">{{_('تاريخ الميلاد')}}</th>
                                            <th scope="col" class="desktop">{{_('تاريخ التوظيف')}}</th>
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
        <div id="table-url" data-url="{{route('user_list')}}"></div>
        <div id="table-url" data-url="{{route('delete_user')}}"></div>

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
            <script src="{{asset('dashboard/admin/js/user/list.js')}}"></script>
            <!-- Delete js -->
            <script src="{{asset('dashboard/admin/js/user/delete.js')}}"></script>
             <!-- Active js -->
             {{-- <script src="{{asset('dashboard/admin/js/user/active.js')}}"></script> --}}
            <!-- App js -->
            <script src="{{asset('dashboard/js/app.js')}}"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/1.3.1/js/toastr.min.js"></script>

    @endpush
@endsection

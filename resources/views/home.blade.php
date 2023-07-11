@extends('admin.index')

@section('content')
    @push('css')
        <!-- DataTables -->
        <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('dashboard/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
            rel="stylesheet" type="text/css" />
    @endpush
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start Page-content-Wrapper -->
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <hr>
                                <hr>
                                <hr>
                                <hr>
                                <hr>
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm text-center text-sm-left">
                                            @if ($users->role_id == 1 || $users->role_id == 0)
                                                <h1>مرحبا بك تم تسجيل الدخول بصلاحية مدير </h1>
                                                <hr>
                                                <hr>
                                                <hr>
                                                <h2>يمكنك الوصول الى مهامك عبر القائمة الجانبية</h2>
                                                <hr>

                                            @elseif ($users->role_id == 2)
                                            <h1>مرحبا بك تم تسجيل الدخول بصلاحية مسؤول شراء </h1>
                                            <hr>
                                            <hr>
                                            <hr>
                                            <h2>يمكنك الوصول الى مهامك عبر القائمة الجانبية</h2>
                                            <hr>
                                            @elseif($users->role_id == 3)
                                            <h1>مرحبا بك تم تسجيل الدخول بصلاحية مستلم مواد </h1>
                                            <hr>
                                            <hr>
                                            <hr>
                                            <h2>يمكنك الوصول الى مهامك عبر القائمة الجانبية</h2>
                                            <hr>
                                            @endif
                                        </div>

                                    </div>
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
        @push('js')
            <!--  datatable js -->
            <script src="{{ asset('dashboard/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
            <!-- Buttons examples -->
            <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('dashboard/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
            <!-- Responsive examples -->
            <script src="{{ asset('dashboard/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('dashboard/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
            <!-- Datatable init js -->
            <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script>
            <script src="{{ asset('dashboard/js/app.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/1.3.1/js/toastr.min.js"></script>
        @endpush
    @endsection

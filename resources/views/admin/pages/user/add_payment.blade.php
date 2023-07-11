@extends('admin.index')

@section('content')
    @push('css')
        <link href="{{ asset('dashboard/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
        <!-- intlTelInput -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
        <style>
            .iti--allow-dropdown input,
            .iti {
                width: 100% !important;
            }

            .iti--allow-dropdown input {
                border: 1px solid #ced4da;
                padding-top: 5px;
                padding-bottom: 5px;
                border-radius: 5px;
            }

            .iti {
                height: 2.1rem !important;
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
                            <h4 class="mb-0 font-size-18">{{ __('إضافة موظف جديد') }}</h4>
                            <ol class="breadcrumb">
                                {{-- {{ Breadcrumbs::render('user.create') }} --}}
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

                                <div class="auth-logo">
                                    <h3 class="text-center">
                                        <a href="#" class="logo d-block ">
                                            <i class="ion ion-logo-usd"></i>
                                        </a>
                                    </h3>
                                </div>

                                <div class="p-3">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                
                                    <form method="POST" action="{{ route('save_payment') }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-center">
                                                </label>

                                            <div class="col-md-6">
                                                <label class="form-label" for="title">
                                                    اختر المستخدم
                                                </label>
                                                <select type="text"
                                                    class="form-control @error('user') is-invalid @enderror" id="user"
                                                    placeholder="user" name="user_id" value="{{ old('user') }}" required>
                                                    <option value="" selected disabled>اختر مسؤول الشراء</option>
                                                    @foreach ($users as $user)
                                                        @if ($user->role_id == 2)
                                                            <option value="{{ $user->id }}">
                                                                {{ $user->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('user')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-center">
                                                </label>

                                            <div class="col-md-6">
                                                <label class="form-label" for="title">
                                                    الدفعة المالية
                                                </label>
                                                <input id="money" type="text"
                                                    class="form-control @error('money') is-invalid @enderror" name="money"
                                                    value="{{ old('money') }}" required autocomplete="money" autofocus
                                                    placeholder="ادخل قيمة الدفعة المالية"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\.*)\./g, '$1');">

                                                @error('money')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('حفظ') }}
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

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
        <!-- validation init -->
        <script src="{{ asset('dashboard/js/pages/form-validation.init.js') }}"></script>
        <!--intlTelInput-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.js"></script>

        <!-- Upload image -->
        <script src="{{ asset('dashboard/admin/js/user/upload_image.js') }}"></script>

        <!-- validation init -->
        <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('dashboard/js/app.js') }}"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#user').select2({
                    width: '100%',
                    placeholder: "Select User",
                    allowClear: true
                });
            });
        </script>
    @endpush
@endsection

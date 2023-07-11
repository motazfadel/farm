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
                height: 2.1rem!important;
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
                            <h4 class="mb-0 font-size-18">{{ __('تعديل معلومات الموظف') }}</h4>
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
                                            <i class="fas fa-user-plus"></i>
                                        </a>
                                    </h3>
                                </div>
                    
                                <div class="p-3">
                    
                                    <form method="POST" action="{{ route('updateuser',$user->id) }}">
                                        @csrf
                    
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-center">{{ __('Name') }}</label>
                    
                                            <div class="col-md-6">
                                                <input id="name" value="{{$user->name}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="الاسم">
                    
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                    
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Email Address') }}</label>
                    
                                            <div class="col-md-6">
                                                <input id="email" value="{{$user->email}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="الإيميل">
                    
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                    
                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label text-md-center">{{ __('Password') }}</label>
                    
                                            <div class="col-md-6">
                                                <input id="password" value="{{$user->password}}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="كلمة المرور">
                    
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- date_birth --}}
                                        <div class="row mb-3">
                                            <label for="date_birth" class="col-md-4 col-form-label text-md-center">{{ __('Date Birth') }}</label>
                    
                                            <div class="col-md-6">
                                                <input id="date_birth" value="{{$user->date_birth}}" type="date" class="form-control @error('date_birth') is-invalid @enderror" name="date_birth" value="{{ old('date_birth') }}" required autocomplete="date_birth" autofocus>
                    
                                                @error('date_birth')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- date_employment --}}
                                        <div class="row mb-3">
                                            <label for="date_employment" class="col-md-4 col-form-label text-md-center">{{ __('Date Employment') }}</label>
                    
                                            <div class="col-md-6">
                                                <input id="date_employment" value="{{$user->date_employment}}" type="date" class="form-control @error('date_employment') is-invalid @enderror" name="date_employment" value="{{ old('date_employment') }}" required autocomplete="date_employment" autofocus>
                    
                                                @error('date_employment')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                    
                                        
                                        <div class="form-check" style="margin-left:100px">
                                            @if($user->role_id == 1)
                                            <input type="radio" name="role_id"  value="1" checked>
                                            <label for="flexRadioDefault1">
                                                مدير
                                            </label>
                                            @else
                                            <input type="radio" name="role_id"  value="1">
                                            <label for="flexRadioDefault1">
                                                مدير
                                            </label>
                                            @endif
                                          </div>

                                          <div class="form-check" style="margin-left:100px">
                                            @if($user->role_id == 2)
                                            <input type="radio" name="role_id" value="2" checked>
                                            <label for="flexRadioDefault2">
                                                مسؤول مشتريات
                                            </label>
                                            @else
                                            <input type="radio" name="role_id" value="2">
                                            <label for="flexRadioDefault2">
                                                مسؤول مشتريات
                                            </label>
                                            @endif
                                          </div>

                                          <div class="form-check" style="margin-left:100px">
                                            @if($user->role_id == 3)
                                            <input type="radio" name="role_id" value="3" checked>
                                            <label for="flexRadioDefault3">
                                                مستلم مواد
                                            </label>
                                            @else
                                            <input type="radio" name="role_id" value="3">
                                            <label for="flexRadioDefault3">
                                                مستلم مواد
                                            </label>
                                            @endif
                                          </div>
                    
                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('تعديل معلومات الموظف') }}
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
        <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
        <!-- App js -->
        <script src="{{ asset('dashboard/js/app.js') }}"></script>
    @endpush

@endsection

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
                            <h4 class="mb-0 font-size-18">{{ __('Create User') }}</h4>
                            <ol class="breadcrumb">
                                {{ Breadcrumbs::render('user.create') }}
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
                                <h4 class="card-title">Create a new User</h4>
                                @include('admin.layouts.message')
                                <form class="custom-validation" id="validation-form" action="{{ route('users.store') }}"
                                    method="post" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="full_name">
                                                    Full Name
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                                                    placeholder="Full Name" name="full_name" value="{{ old('full_name') }}" required>
                                                @error('full_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            {{-- <div class="mb-3 form-group">
                                                <label class="form-label" for="user_name">
                                                    User Name
                                                </label>
                                                <input data-parsley-type="alphanum" type="text"
                                                    class="form-control @error('user_name') is-invalid @enderror" id="user_name"
                                                    placeholder="User Name" name="user_name" value="{{ old('user_name') }}"
                                                    required>
                                                @error('user_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> --}}
                                        </div>
                                        <!-- End Col -->
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="email">
                                                    Email
                                                </label>
                                                <input type="email" parsley-type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    placeholder="Email" name="email" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="password">
                                                    Password
                                                </label>
                                                <input type="password" data-parsley-minlength="6"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" placeholder="Password" name="password"
                                                    value="{{ old('password') }}" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- End Col -->
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="password_confirmation">
                                                    Confirm Password
                                                </label>
                                                <input type="password" data-parsley-equalto="#password" data-parsley-minlength="6"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="password_confirmation" placeholder="Confirm Password"
                                                    name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                    required>
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="address">
                                                    Address
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('address') is-invalid @enderror" id="name"
                                                    placeholder="Address" name="address" value="{{ old('address') }}"
                                                    required>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="phone">Phone Number</label>
                                                <input class="form-control @error('phone') is-invalid @enderror"
                                                    type="tel" pattern="[+]{0,1}[0-9]{8,13}" name="phone"
                                                    id="phone" minlength="9" maxlength="13" value="{{old('phone') ? old('phone'): '+971'}}"
                                                    autocomplete="phone" autofocus placeholder="Enter the phone" required>
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                 

                                    <div class="row" id="image_container">
                                        <div class="col-lg-6">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="image_select">
                                                    Image (1:1)
                                                </label>
                                                <input type="file" accept="image/png, image/jpeg, image/png, image/gif"
                                                    class="form-control" id="image_select" name="image">
                                                <button style="margin-top: 5px" type="button" id="remove_image_button"
                                                    class="btn btn-sm btn-link p-0 display-none">
                                                    Remove image
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Row -->

                                    {{-- <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="phone">Phone Number</label>
                                                <input class="form-control @error('phone') is-invalid @enderror"
                                                    type="tel" pattern="[+]{0,1}[0-9]{8,13}" name="phone"
                                                    id="phone" minlength="9" maxlength="13" value="{{old('phone') ? old('phone'): '+971'}}"
                                                    autocomplete="phone" autofocus placeholder="Enter the phone" required>
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row --> --}}

                                    <button class="btn btn-primary" type="submit">Submit</button>
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
        <!-- validation init -->
        <script src="{{ asset('dashboard/js/pages/form-validation.init.js') }}"></script>
        <!--intlTelInput-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.js"></script>

         <!-- Upload image -->
         <script src="{{ asset('dashboard/admin/js/user/upload_image.js') }}"></script>

        <!-- validation init -->
        <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
        <script>
            var inputt = document.querySelector('#phone');
            var countryData = window.intlTelInputGlobals.getCountryData();
            var addressDropdow = document.querySelector("#addresss-country");
            var it2 = window.intlTelInput(inputt, {
                utilScript: 'js/utils.js'
            });
            for (var i = 0; i < countryData.length; i++) {
                var country = countryData[i];
                var optionNode = document.createElement("option");
                optionNode.value = country.iso2;
                var textNode = document.createTextNode(country.name);
                optionNode.appendChild(textNode);
                addressDropdow.appendChild(optionNode);
            }
    
            addressDropdow.value = it2.getSelectedCountryData().iso2;
    
            // listen to the telephone input for changes
            inputt.addEventListener('countrychange', function(e) {
                addressDropdow.value = it2.getSelectedCountryData().iso2;
            });
    
            // listen to the address dropdown for changes
            addressDropdow.addEventListener('change', function() {
                it2.setCountry(this.value);
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.select2-2').select2({
                    width: '100%',
                    placeholder: "Select an Option",
                    allowClear: true,
                });
            });
        </script>
        <script>
            $(function() {
                $('#validation-form').validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 6
                        },
                        password_confirmation: {
                            required: true,
                            minlength: 6,
                            equalTo: "#password"
                        },
                        phone: {
                            required: true,
                            minlength: 13
                        },
                    },
                    messages: {
                        phone: {
                            required: "Please provide a phone number",
                            minlength: "Phone number must be at least 13 characters long"
                        },
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                        password_confirmation: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long",
                            equalTo: "Password and Password Confirmation must be match"
                        }
                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-control').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
        </script>

        <!-- App js -->
        <script src="{{ asset('dashboard/js/app.js') }}"></script>
    @endpush

@endsection

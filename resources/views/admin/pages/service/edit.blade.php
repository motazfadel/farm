@extends('admin.index')

@section('content')
    @push('css')
        <link href="{{ asset('dashboard/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
        <link href="{{asset('dashboard/libs/summernote/summernote.min.css')}}" rel="stylesheet" type="text/css"/>
        
        <style>
            a, a:hover {
                color: white;
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
                            <h4 class="mb-0 font-size-18">{{ __('Edit Service') }}</h4>
                            <ol class="breadcrumb">
                                {{ Breadcrumbs::render('service.edit', $service) }}
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
                                <h4 class="card-title">Edit Service</h4>
                                @include('admin.layouts.message')
                                <form class="needs-validation" id="validation-form"
                                    action="{{ route('services.update', $service) }}" method="post"
                                    enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="title">
                                                    Service Name
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    id="title"
                                                    placeholder="Service Name"
                                                    name="title"
                                                    value="{{ $service->title }}"
                                                    required>
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="price">
                                                    Price
                                                </label>
                                                <input type="number"
                                                       step="0.01" min="1.00"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       id="price"
                                                       placeholder="Price"
                                                       name="price"
                                                       min="1"
                                                       value="{{ $service->price }}"
                                                       required>
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        <!-- End Col -->
                                       
                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="description">
                                                    Description
                                                </label>
                                                <textarea
                                                       class="form-control @error('description') is-invalid @enderror"
                                                       id="description"
                                                       placeholder="Description"
                                                       name="description"
                                                       required>{{ $service->description }}</textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div> --}}
                                    <!-- End Row -->

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
                                        <img src="{{ asset(SERVICE_IMG.$service->image) }}" id="image_preview"
                                            class="img-fluid col-md-6" style="width: 132px;margin-top: 5px">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8" style="">
                                            <div class="mb-3 form-group">
                                                <label class="form-label">Sub Service:</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Row -->
                                    @foreach($service->subServices as $subservice)
                                    <div class="row"  style="margin-bottom:1rem;">
                                        <div class="col-md-8">
                                            <div class="mb-3 form-group">
                                                <li>{{$subservice->name}}</li>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="{{ route('sub_service.delete', $subservice->id) }}"><button type="button" class="btn btn-danger delete-extra" onclick="return confirm('Are you sure you want to delete this service?')"><i class="far fa-trash-alt"></i></button></a>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                    @endforeach

                                    <div class="row">
                                        <div class="col-md-7" style="">
                                            <?php $i='0'; ?>
                                            <div class="mb-3 form-group" id="popup">
                                                {{-- <label class="form-label">Sub Service:</label> --}}
                                                <div class="" id="contactContainers">
                                                    <div class="phones" id="subService" style="margin-bottom:5px; display: flex;">
                                                        <input name="phonenumbers[<?php $i++ ?>]" type="text" class="form-control @error('phonenumbers') is-invalid @enderror"
                                                        id="phonenumbers"
                                                        placeholder="Sub Service Name">
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-default add-new-extra btn-xs ars adds">+</button>
                                                            <button type="button" class="btn btn-danger delete-extra ars removes">-</button>
                                                        </div>
                                                        {{-- <div class="col-md-1">
                                                        </div> --}}
                                                        {{-- <div class="invalid-feedback">
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Row -->

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"></script>
        <script src="{{asset('dashboard/libs/summernote/summernote.min.js')}}"></script>

        <!-- validation init -->
        <script src="{{ asset('dashboard/js/pages/form-validation.init.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

        <!-- Upload image -->
        <script src="{{ asset('dashboard/admin/js/service/upload_image.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('dashboard/js/app.js') }}"></script>

         <script>
            const $containers = $('#contactContainers')
            $(".removes").eq(0).hide()
                $containers.on('click', ".ars", function(e) {
                const adds = $(this).is(".adds");
                const $phoness = $containers.find(".phones");
                const lens = $phoness.length;
                if (adds) {
                    const $newPhones = $phoness.eq(0).clone(true)
                    $newPhones.find("[name=phonenumbers]")
                    .attr("id", `new_${$phoness.length}`)
                    .val("");
                    $containers.append($newPhones);
                    $newPhones.find(".adds").hide(); // if you only want one plus
                    $newPhones.find(".removes").show()
                } else {
                    $(this).closest(".phones").remove()
                }
        
            })
        </script>

<script>
    $(document).ready(function(){
        $('#validation-form').validate({
            ignore: [],
            debug: false,
            rules: {
                description:{

                        minlength:12
                      }
            },
            messages: {
                description:{
                          required:"This Value Is Required.",
                          minlength:"Please enter at least 3 characters."
  
                      }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
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

    @endpush
@endsection

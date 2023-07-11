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

            .btn-toggle[data-type="1"] {
                background-color: green;
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
                            {{-- <h4 class="mb-0 font-size-18">إنشاء فاتورة شراء</h4> --}}
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
                                {{-- <h4 class="card-title">إنشاء فاتورة شراء</h4> --}}
                                @include('admin.layouts.message')
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-center">
                                    </label>

                                    <div class="col-md-6">
                                        <label class="form-label" for="title">
                                            اختر مستلم المواد
                                        </label>
                                        <select type="text" class="form-control @error('user') is-invalid @enderror"
                                            id="user" placeholder="user" name="user" value="{{ old('user') }}"
                                            required>
                                            <option value="" selected disabled>اختر مستلم المواد</option>
                                            @foreach ($users as $user)
                                                @if ($user->role_id == 3)
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
                                <table id="invoices-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>رقم الصنف</th>
                                            <th>اسم الصنف</th>
                                            <th>الكمية</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Invoices as $Invoice)
                                            <tr>
                                                <td>{{ $Invoice->id }}</td>
                                                <td>{{ $Invoice->name }}</td>
                                                <td>{{ $Invoice->quantity }}</td>
                                                <td>
                                                    <form id="maindata" action="/material/{{ $Invoice->id }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="button" class="btn btn-primary btn-toggle"
                                                            data-type="{{ $Invoice->type }}">
                                                            {{ $Invoice->type == 0 ? 'تسليم' : 'تم التسليم' }}
                                                        </button>

                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
            $(document).ready(function() {
                $('.btn-toggle').click(function() {
                    var btn = $(this);
                    var status = btn.attr('data-type');
                    var user = $('#user').val();
                  
                    // التحقق من حالة الفاتورة
                    if (status == '1') {
                        Swal.fire({
                            icon: 'error',
                            text: '!..لقد تم تسليم هذا الصنف سابقا '
                        });
                        return false;
                    }
                      if (user == null) {
                        Swal.fire({
                            icon: 'error',
                            text: '!..يجب اختيار مستلم المواد'
                        });
                        return false;
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    event.preventDefault(); // منع النموذج من الإرسال الافتراضي

                    // الحصول على النموذج الذي يحتوي على الزر
                    var form = $(this).closest('form');

                    // الحصول على القيمة الحالية لـ action
                    var url = form.attr('action');
                    var formDataArray = $(this).serializeArray(); // جمع بيانات النموذج وتحويلها إلى مصفوفة
                    formDataArray.push({
                        name: 'user',
                        value: $('#user').val()
                    }); // إضافة قيمة المدخل user إلى المصفوفة
                    var formData = $.param(formDataArray); // تحويل المصفوفة إلى سلسلة نصية
                    console.log(formData); // طباعة بيانات النموذج في وحدة التحكم (Console)

                    $.ajax({
                        method: 'post',
                        url: url,
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // تحديث لون الزر بعد التحديث الناجح
                            var btn = form.find('.btn-toggle');
                            var type = btn.attr('data-type');
                            if (type == 0) {
                                btn.removeClass('btn-primary').addClass('btn-success');
                                btn.attr('data-type', 1);
                                btn.text('تم التسليم');
                            } else {
                                btn.removeClass('btn-success').addClass('btn-primary');
                                btn.attr('data-type', 0);
                                btn.text('تسليم');
                            }
                        }
                    });
                });
            });
        </script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#user').select2({
                    width: '100%',
                    placeholder: "Select User",
                    required: true
                });
            });
        </script>
    @endsection

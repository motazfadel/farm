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

            .css_style {
                text-align: center;
                margin-left: 200px;
                margin-bottom: 50px;
                padding: 10px
            }

            .css_style1 {
                text-align: center;
                margin-left: 200px;
                padding: 10px
            }

            .css_style3 {
                text-align: center;
                padding: 10px
            }

            .css_style2 {
                padding: 20px;
                margin-left: 175px;

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
                            <h4 class="mb-0 font-size-18">إنشاء فاتورة شراء</h4>
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
                                <h4 class="card-title">إنشاء فاتورة شراء</h4>
                                @include('admin.layouts.message')

                                <form method="POST" action="{{ route('save_invoice') }}">
                                    @csrf
                                    <table class="css_style">
                                        <thead>
                                            <tr>
                                                <th>اسم الصنف</th>
                                                <th>العدد</th>
                                                <th>السعر</th>
                                                <th>المجموع الفرعي</th>
                                            </tr>
                                        </thead>
                                        <tbody id="items">
                                            <tr>
                                                <td><input type="text" name="name[]" onchange="calculateSubtotal()" required>
                                                </td>
                                                <td><input type="number" name="quantity[]" onchange="calculateSubtotal()" required>
                                                </td>
                                                <td><input type="number" name="price[]" onchange="calculateSubtotal()" required>
                                                </td>
                                                <td><input type="number" name="subtotal[]" readonly required></td>
                                                <td><input type="text" name="type[]"
                                                    value={{0}} hidden></td>

                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="button" onclick="addRow()" class="css_style1">إضافة صف جديد</button>
                                    <button type="button" onclick="deletRow()" class="css_style3">حذف صف جديد</button>

                                    <label for="total" class="css_style2" required>المجموع النهائي:</label>
                                    <input type="number" id="total" name="total" readonly>
                                    <input type="text" id="user_name" name="user_name" value={{ Auth::user()->name }}
                                        hidden>
                                    <input type="text" id="user_id" name="user_id" value={{ Auth::user()->id }} hidden>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary" style="width: 150px;">
                                                {{ __('حفظ') }}
                                            </button>
                                        </div>
                                    </div>
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

        <script>
            function calculateSubtotal() {
                const rows = document.querySelectorAll('#items tr');
                let total = 0;

                rows.forEach(row => {
                    const name = row.querySelector('input[name="name[]"]').value;
                    const quantity = row.querySelector('input[name="quantity[]"]').value;
                    const price = row.querySelector('input[name="price[]"]').value;
                    const type = row.querySelector('input[name="type[]"]').value;
                    const subtotal = quantity * price;

                    row.querySelector('input[name="subtotal[]"]').value = subtotal;
                    total += subtotal;
                });

                document.getElementById('total').value = total;
            }

            function addRow() {
                const tbody = document.getElementById('items');
                const row = `
              <tr>
                <td><input type="text" name="name[]" onchange="calculateSubtotal()"></td>
                <td><input type="number" name="quantity[]" onchange="calculateSubtotal()"></td>
                <td><input type="number" name="price[]" onchange="calculateSubtotal()"></td>
                <td><input type="number" name="subtotal[]" readonly></td>
                <td><input type="text" name="type[]" value={{0}} hidden>0</td>
              </tr>
            `;

                tbody.insertAdjacentHTML('beforeend', row);
            }

            function deletRow() {
                var table = document.getElementById("items");
                var rowCount = table.rows.length;

                // Check if there is only one row left in the table
                if (rowCount <= 1) {
                    alert("لا يمكن حذف أخر صف!");
                    return;
                }

                // Delete the last row
                table.deleteRow(rowCount - 1);

                // Recalculate the total
                calculateTotal();
            }
        </script>
    @endpush
@endsection

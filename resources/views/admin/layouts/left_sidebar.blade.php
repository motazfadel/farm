<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <div class="user-details">
            <div class="d-flex">
                <div class="me-2">
                    <img src="{{ asset('dashboard/images/users/avatar-4.jpg') }}" alt=""
                        class="avatar-md rounded-circle">
                </div>
                <div class="user-info w-100">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Donald Johnson
                            <i class="mdi mdi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" class="dropdown-item"><i
                                        class="mdi mdi-account-circle text-muted me-2"></i>
                                    Profile<div class="ripple-wrapper me-2"></div>
                                </a></li>
                            <li><a href="javascript:void(0)" class="dropdown-item"><i
                                        class="mdi mdi-cog text-muted me-2"></i>
                                    Settings</a></li>
                            <li><a href="javascript:void(0)" class="dropdown-item"><i
                                        class="mdi mdi-lock-open-outline text-muted me-2"></i>
                                    Lock screen</a></li>
                            <li><a href="javascript:void(0)" class="dropdown-item"><i
                                        class="mdi mdi-power text-muted me-2"></i>
                                    Logout</a></li>
                        </ul>
                    </div>

                    <p class="text-white-50 m-0">{{ __('Administrator') }}</p>
                </div>
            </div>
        </div>


        <!--- Sidemenu -->
        <div id="sidebar-menu">
            @if (auth()->user()->role_id == 1)
                <div class="name" style="text-align: center">
                    <h3>Admin</h3><br>
                    <h5>مدير</h5>
                </div>
            @elseif(auth()->user()->role_id == 2)
                <div class="name" style="text-align: center">
                    <h3>Officer purchases</h3><br>
                    <h5>مسؤول مشتريات</h5>
                </div>
            @elseif(auth()->user()->role_id == 3)
                <div class="name" style="text-align: center">
                    <h3>Material recipient</h3><br>
                    <h5>مستلم مواد</h5>
                </div>
            @endif

            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">{{ __('Main') }}</li>
                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="mdi mdi-home"></i>
                        <span>{{ __('لوحة التحكم') }}</span>
                    </a>
                </li>
                {{-- Admin --}}
                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 0)
                <li>
                    <a href="{{ route('adduser') }}" class="waves-effect">
                        <i class="fas fa-user-plus"></i>
                        <span>{{ __('إضافة موظف جديد') }}</span>
                    </a>
                   
                </li>
                <li>
                    <a href="{{ route('userindex') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('عرض الموظفين') }}</span>
                    </a>
                   
                </li>
                <li>
                    <a href="{{ route('add_pyment') }}" class="waves-effect">
                        <i class="fas fa-credit-card"></i>
                        <span>{{ __('إضافة دفعة مالية') }}</span>
                    </a>
                   
                </li>
                <li>
                    <a href="{{ route('list') }}" class="waves-effect">
                        <i class="ion ion-ios-list-box"></i>
                        <span>{{ __('عرض التقارير') }}</span>
                    </a>
                   
                </li>

                <li>
                    <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><i
                        class="mdi mdi-power font-size-16 align-middle me-2 text-primary"></i>
                    <span>تسجيل الخروج</span></a>
                   
                </li>

                @endif

                 {{-- Officer --}}
                @if (auth()->user()->role_id == 2)
                <li>
                    <a href="{{ route('create_invoice') }}" class="waves-effect">
                        <i class="ion ion-ios-create"></i>
                        <span>{{ __('إنشاء فاتورة شراء') }}</span>
                    </a>
                   
                </li>
                <li>
                    <a href="{{ route('receipt_money') }}" class="waves-effect">
                        <i class="fas fa-credit-card"></i>
                        <span>{{ __('استلام مبلغ مالي') }}</span>
                    </a>
                   
                </li>
                <li>
                    <a href="{{ route('material_delivery') }}" class="waves-effect">
                        <i class=" ion ion-ios-cart"></i>
                        <span>{{ __('تسليم مواد') }}</span>
                    </a>
                   
                </li>
                <li>
                    <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><i
                        class="mdi mdi-power font-size-16 align-middle me-2 text-primary"></i>
                    <span>تسجيل الخروج</span></a>
                   
                </li>
                @endif

                @if (auth()->user()->role_id == 3)
                <li>
                    <a href="{{ route('material_receiver') }}" class="waves-effect">
                        <i class="ion ion-ios-create"></i>
                        <span>{{ __('استلام مواد') }}</span>
                    </a>
                   
                </li>
                <li>
                    <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><i
                        class="mdi mdi-power font-size-16 align-middle me-2 text-primary"></i>
                    <span>تسجيل الخروج</span></a>
                   
                </li>
                @endif



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

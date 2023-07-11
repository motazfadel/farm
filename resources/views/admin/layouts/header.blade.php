<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color: #fff !important;">
                <a href="{{ route('home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                    </span>
                    <span class="logo-lg">
                    </span>
                </a>
                <a href="{{ route('home') }}" class="logo logo-light">
                    <span class="logo-sm">
                    </span>
                    <span class="logo-lg">
                    </span>
                </a>
            </div>
            <!-- Menu Icon -->
            <button type="button" class="btn px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- <span class="user-name">{{ auth()->user()->name }}</span> --}}
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset('dashboard/images/users/avatar-4.jpg') }}" alt="Header Avatar">
                </button>

                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"><i
                            class="mdi mdi-power font-size-16 align-middle me-2 text-primary"></i>
                        <span>Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

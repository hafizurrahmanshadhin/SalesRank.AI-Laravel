<div class="topbar-custom">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button class="button-toggle-menu nav-link">
                        <i data-feather="menu" class="noti-icon"></i>
                    </button>
                </li>
                <li class="d-none d-lg-block">
                    <h5 class="mb-0">Good Morning,
                        {{ ucfirst(Auth::user()->first_name) ?? '' }}</h5>
                </li>
            </ul>

            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                {{-- Button Trigger Customizer Offcanvas Start --}}
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                    </button>
                </li>
                {{-- Button Trigger Customizer Offcanvas End --}}

                {{-- Light/Dark Mode Button Start --}}
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" id="light-dark-mode">
                        <i data-feather="moon" class="align-middle dark-mode"></i>
                        <i data-feather="sun" class="align-middle light-mode"></i>
                    </button>
                </li>
                {{-- Light/Dark Mode Button End --}}

                {{-- User Dropdown Start --}}
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img class="rounded-circle"
                            src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('assets/img/user_placeholder.png') }}"
                            alt="Profile Picture">
                        <span class="pro-user-name ms-1">{{ ucfirst(Auth::user()->first_name) ?? '' }}
                            <i class="mdi mdi-chevron-down"></i></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <a href="pages-profile.html" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                            <span>My Account</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="javascript:void(0);" class="dropdown-item notify-item"
                            onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                            <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                            <span>Logout</span>
                        </a>
                        <form action="{{ route('logout') }}" method="post" id="logoutForm">
                            @csrf
                        </form>
                    </div>
                </li>
                {{-- User Dropdown End --}}
            </ul>
        </div>
    </div>
</div>

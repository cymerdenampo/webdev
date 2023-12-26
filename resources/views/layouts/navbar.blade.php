<!-- ======= Header/Navbar ======= -->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top " data-sticky-container>
    <div class="container-fluid custom-container">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand text-brand" href="/">
            <img class="mb-3" src="" alt="" style="width: auto; max-height: 60px;">Contact
            System<span class="color-b">
        </a>

        <div class="navbar-collapse collapse justify-content-centerx" id="navbarNavDropdown">
            <ul class="navbar-nav">

                @guest

                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="/about-us">About
                            Us</a>
                    </li> --}}

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login/user') ? 'active' : '' }}"
                            href="{{ route('user.login') }}">Login</a>
                    </li>
                @endauth

                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                            <i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/index') ? 'active' : '' }}" href="index">
                            <i class="fa-solid fa-address-book"></i> Contact</a>
                    </li>

                    @role('user')
                        {{-- @if (auth()->user()->plan == 'free')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('my-listings') ? 'active' : '' }}" href="/my-listings"><i class="fa-solid fa-briefcase"></i> Want to be a seller?</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('my-listings') ? 'active' : '' }}" href="/my-listings"><i class="fa-solid fa-briefcase"></i> My Listings</a>
                        </li>
                        @endif --}}

                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="unreadMessagesDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-regular fa-envelope"></i> Notifications
                                <span class="badge badge-danger" style="vertical-align: middle; display:none; ">0</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="unreadMessagesDropdown">
                            </div>
                        </li> --}}
                    @endrole

                    @role('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('user-list') ? 'active' : '' }}" href="/user-list"><i
                                    class="fa-solid fa-users"></i> Users</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('feature-payments') ? 'active' : '' }}"
                                href="/feature-payments">Feature Payments</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('payments') ? 'active' : '' }}" href="/payments"><i
                                    class="fa-solid fa-credit-card"></i> Payments</a>
                        </li>
                    @endrole



                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('my-account') ? 'active' : '' }}" href="/my-account">
                            <i class="fa-regular fa-user"></i> My Account</a>
                    </li> --}}


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="x" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-regular fa-user"></i> My Account
                            <span class="badge badge-danger" style="vertical-align: middle; display:none; ">0</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="x">
                            <a href="/settings-and-privacy" class="dropdown-item">Settings & Privacy</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                class="dropdown-item">Logout</a>
                        </div>
                    </li>



                    {{-- <li class="nav-item">
                        <a class="nav-link " href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    </li> --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endauth

            </ul>
        </div>

        {{-- <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse"
            data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
            <i class="bi bi-search"></i>
        </button> --}}

</nav><!-- End Header/Navbar -->
<nav class="navbar fixed-top navbar-expand-lg main-navbar--main">
    <div class="container-lg container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Navbar</a>
        <button class="navbar-toggler navbar-toggler-improve" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" id="navbarTogglerButton" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="menu-container">
                <button class="mobile-menu-close close-menu">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <ul class="navbar-nav me-lg-auto mb-2 mb-lg-0 main-menu navbar-mobile-menu">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('homestays') }}">HomeStay</a>
                    </li>
                    {{-- <li class="nav-item">
                    <a class="nav-link" href="{{route('products')}}">Products</a>
                </li> --}}
                    {{-- <li class="nav-item">
                    <a class="nav-link" href="{{route('blogs')}}">Blogs</a>
                </li> --}}
                </ul>
                <ul
                    class="ms-lg-auto login-register d-block d-lg-flex justify-content-start justify-content-lg-end align-items-start align-items-lg-end gap-3 navbar-mobile-menu">
                    @if (Auth::user())
                        @if (Auth::user()->role === 'user')
                            <li>
                                <form action="{{ route('logout') }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="d-inline bg-transparent border-0">
                                        <p>Logout</p>
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('seller.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="d-inline bg-transparent border-0">
                                        <p>Logout</p>
                                    </button>
                                </form>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">
                                Register
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>

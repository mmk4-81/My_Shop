<div class="container">
    <div class="header_top ">
        <!-- Header Right -->
        <div class="header_right ">
            <a href="{{ url('/') }}"><img src="{{ asset('logo/logo.png') }}" id="logo" width="100px"
                    height="70px" alt="logo" /></a>
            <ul class="menu_list">
                <a href="{{ url('/') }}" class="navlink">
                    <li class="menu_item selected">صفحه اصلی</li>
                </a>
                <a href="#" class="navlink">
                    <li class="menu_item">محصولات</li>
                </a>
                <a href="#" class="navlink">
                    <li class="menu_item">فروشگاه ها </li>
                </a>
            </ul>
        </div>

        <!-- Header Left -->
        <div class="header_left">
            <i class="fas fa-moon mod" id="moon-icon"></i>
            <a href="#" class="cartlink">
                <i class="fas fa-shopping-cart mod"></i>
            </a>
            @if (Route::has('login'))
                @auth

                    <div class="dropdown">
                        <a href="#" class="avatar" id="avatarDropdown">
                            <img src="{{ asset('uploads/avatars/1720985528.png') }}" alt="User Avatar" class="avatar-img">
                        </a>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="{{ url('/profile') }}" class="dropdown-item">پروفایل</a>
                            @if (Auth::check())
                                @if (Auth::user()->hasRole('seller'))
                                    <a href="{{ url('seller-panel/dashboard') }}" class="dropdown-item">پنل فروشگاه</a>
                                @else
                                    <a href="{{ url('create-store') }}" class="dropdown-item">ساخت فروشگاه</a>
                                @endif
                            @endif

                            @if (Auth::user()->hasRole('admin'))
                                <a href="{{ url('admin-panel/dashboard') }}" class="dropdown-item">پنل ادمین</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                                @csrf
                                <input type="submit" class="btn btn-link logout" value="خروج از حساب کاربری">
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="loginlink ">
                        <p class="loginhover">ورود / ثبت نام </p>
                    </a>
            </div>
        @endauth
        @endif
    </div>
</div>
<script src="{{ asset('js/navbar.js') }}"></script>

<div class="container">
    <div class="header_top ">
        <!-- Header Right -->
        <div class="header_right ">
            <a href="{{ url('/') }}"><img src="{{ asset('logo/logo.png') }}" id="logo" width="100px"
                    height="70px" alt="logo" /></a>
            <ul class="menu_list">
                <a href="{{ url('/') }}" class="navlink">
                    <li class="menu_item {{ Request::is('/') ? 'selected' : '' }}">صفحه اصلی</li>
                </a>
                <li class="menu_item {{ Request::is('categories*') ? 'selectedd' : '' }} {{ Request::is('products*') ? 'selectedd' : '' }}">
                    <a href="#" class="navlink drop">
                        محصولات
                    </a>
                    @php
                        $parentCategories = App\Models\Category::where('parent_id', 0)->get();
                    @endphp
                    <ul class=" mega-menu">
                        @foreach ($parentCategories as $parentCategory)
                            <li  >
                                <a class="menu-title" href="#">
                                    {{ $parentCategory->category_name }}
                                </a>
                                <ul class="submenu">
                                    @foreach ($parentCategory->children as $childCategory)
                                        <li><a href="{{ route('home.category.show', ['category' => $childCategory->slug ]) }}">{{ $childCategory->category_name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>


                <a href="{{ url('/shops') }}" class="navlink">
                    <li class="menu_item {{ Request::is('shops*') ? 'selected' : '' }}">فروشگاه ها </li>
                </a>
            </ul>

        </div>

        <!-- Header Left -->
        <div class="header_left">
            <i class="fas fa-moon mod" id="moon-icon"></i>
            <a href="{{ route('cart.show') }}" class="cartlink">
                <i class="fas fa-shopping-cart mod {{ Request::is('cart*') ? 'selectedcart' : '' }}"></i>
                @if(session()->has('cart') && count(session('cart')) > 0)
                    <span class="cart-badge">{{ count(session('cart')) }}</span>
                @endif
            </a>

            @if (Route::has('login'))
                @auth

                    <div class="dropdown">
                        <a href="#" class="avatar" id="avatarDropdown">
                            <img src="{{ Auth::user()->avatar ? asset('uploads/avatars/' . Auth::user()->avatar) : '' }}" alt="..." class="avatar-img">

                        </a>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="{{ url('/profile') }}" class="dropdown-item">پروفایل</a>
                            @if (Auth::check())
                                @if (Auth::user()->hasRole('seller'))
                                    <a href="{{ url('seller-panel/dashboard') }}" class="dropdown-item">پنل فروشگاه</a>
                                @else
                                    <a href="{{ url('shops/create') }}" class="dropdown-item">ساخت فروشگاه</a>
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
                    <a href="{{ route('login') }}" class="loginlink2 ">
                        <h6 class="loginhover">ورود / ثبت نام </h6>
                    </a>
            </div>
        @endauth
        @endif
    </div>
</div>
<script src="{{ asset('js/navbar.js') }}"></script>

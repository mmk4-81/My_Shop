<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar">
                {{-- <img src="{{ $shop && $shop->avatar_shops ? asset('uploads/avatars/' . $shop->avatar_shops) : asset('seller-panelcss/img/mypic.png') }}"
                    alt="..." class="img-fluid rounded-circle"> --}}
                <img src="{{ asset('uploads/avatars/1720967302.jpg') }}" alt="..." class="img-fluid rounded-circle">

            </div>
            <div class="title">
                {{-- <h1 class="h5 m-2">{{ $user->name }}</h1> --}}
                <h1 class="h5 m-2">محمد مهدی کربلایی</h1>
                {{-- <p class="m-2">{{ $shop ? $shop->shop_name : 'نام فروشگاه' }}</p> --}}
                <p class="m-2">بوتیک سفید</p>
            </div>
        </div>
        <div class="d-flex flex-md-column align-items-center ">
            <li class="{{ Request::is('seller-panel/followers') ? 'active' : '' }}">
                <a href="{{ url('/seller-panel/followers') }}">
                    <i class=""></i> دنبال کننده ها: 15
                </a>
            </li>
            <li class="{{ Request::is('seller-panel/following') ? 'active' : '' }}">
                <a href="{{ url('/seller-panel/following') }}">
                    <i class=""></i> دنبال‌شونده ها: 20
                </a>
            </li>

        </div>
        <span class="heading">پیشخوان</span>
        <ul class="list-unstyled">
            <li class="{{ Request::is('seller-panel/dashboard') ? 'active' : '' }}">
                <a href="{{ url('/seller-panel/dashboard') }}"> <i class=""></i> داشبورد </a>
            </li>
            <li class="{{ Request::is('seller-panel/attributes*') ? 'active' : '' }}">
                <a href="{{ url('/seller-panel/attributes') }}"> <i class=""></i> ویژگی ها </a>
            </li>
            <li class="{{ Request::is('seller-panel/categories*') ? 'active' : '' }}">
                <a href="{{ url('/seller-panel/categories') }}"> <i class=""></i> دسته بندی ها </a>
            </li>
            <li class="{{ Request::is('seller-panel/products*') ? 'active' : '' }}">
                <a href="{{ url('/seller-panel/products') }}"> <i class=""></i> محصولات </a>
            </li>
            <li class="{{ Request::is('seller-panel/orders*') ? 'active' : '' }}">
                <a href="{{ url('/seller-panel/orders') }}"> <i class=""></i> سفارشات </a>
            </li>
        </ul>
    </nav>
</div>

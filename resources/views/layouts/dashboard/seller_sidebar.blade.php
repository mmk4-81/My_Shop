<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar">
                <img src="{{ Auth::user()->shop && Auth::user()->shop->avatar_shops ? asset('uploads/avatars/shops/' . Auth::user()->shop->avatar_shops) : asset('seller-panelcss/img/mypic.png') }}" alt="..." class="img-fluid rounded-circle">
            </div>
            <div class="title">
                <h1 class="h5 m-2">{{ Auth::user()->shop ? Auth::user()->shop->shop_name : 'نام فروشگاه' }}</h1>
                <p class="m-2">{{ Auth::user()->name }}</p>
            </div>
        </div>


        <span class="heading">پیشخوان</span>
        <ul class="list-unstyled">
            <li class="{{ Request::is('seller-panel/dashboard') ? 'active' : '' }}">
                <a href="{{ url('/seller-panel/dashboard') }}"> <i class=""></i> داشبورد </a>
            </li>
            <li class="{{ Request::is('seller-panel/myshop*') ? 'active' : '' }}">
                <a href="{{ url('/seller-panel/myshop') }}"> <i class=""></i> فروشگاه من </a>
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
            <li >
                <a href="{{ url('/profile') }}"><i class=""></i>پروفایل</a>
            </li>
        </ul>
    </nav>
</div>

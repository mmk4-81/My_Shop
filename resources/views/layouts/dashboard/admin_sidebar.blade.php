<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar">
                <img src="{{asset('uploads/avatars/1720967302.jpg')}}" alt="..." class="img-fluid rounded-circle">
                {{-- <img src="{{ $user->avatar ? asset('uploads/avatars/' . $user->avatar) : asset('admincss/img/mypic.png') }}" alt="..." class="img-fluid rounded-circle"> --}}
            </div>
            <div class="title">
                {{-- <h1 class="h5 m-2">{{ $user->name }}</h1> --}}
                <h1 class="h5 m-2">محمدمهدی کربلایی</h1>
                {{-- <p class="m-2">@yield('user-role')</p> --}}
                <p class="m-2">ادمین سایت</p>
            </div>
        </div>
        <span class="heading">پیشخوان</span>
        <ul class="list-unstyled">
            <li class="{{ Request::is('admin-panel/dashboard') ? 'active' : '' }}">
                <a href="{{ url('/admin-panel/dashboard') }}"> <i class=""></i> داشبورد </a>
            </li>
            <li class="{{ Request::is('admin-panel/users*') ? 'active' : '' }}">
                <a href="{{ url('/admin-panel/users') }}"> <i class=""></i>  کاربران </a>
            </li>
            <li class="{{ Request::is('admin-panel/shops*') ? 'active' : '' }}">
                <a href="{{ url('/admin-panel/shops') }}"> <i class=""></i> فروشگاه ها</a>
            </li>
            <li class="{{ Request::is('admin-panel/attributes*') ? 'active' : '' }}">
                <a href="{{ url('/admin-panel/attributes') }}"> <i class=""></i> ویژگی ها </a>
            </li>
            <li class="{{ Request::is('admin-panel/categories*') ? 'active' : '' }}">
                <a href="{{ url('/admin-panel/categories') }}"> <i class=""></i> دسته بندی ها </a>
            </li>
            <li class="{{ Request::is('admin-panel/products*') ? 'active' : '' }}">
                <a href="{{ url('/admin-panel/products') }}"> <i class=""></i>  محصولات  </a>
            </li>
             <li class="{{ Request::is('admin-panel/orders*') ? 'active' : '' }}">
                <a href="{{ url('/admin-panel/orders') }}"> <i class=""></i> سفارشات </a>
            </li>
        </ul>
    </nav>
</div>

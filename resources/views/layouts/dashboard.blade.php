<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('onvan')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('admincss/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/css/font.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <link rel="stylesheet" href="{{ asset('admincss/css/style.default.css') }}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{ asset('admincss/css/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('admincss/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
</head>

<body>
    @include('layouts.dashboard.header')
    <div class="d-flex">
        @if (Request::is('admin*'))
            @include('layouts.dashboard.admin_sidebar')
        @else
            @include('layouts.dashboard.seller_sidebar')
        @endif
        <div class="page-content flex-grow-1">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom" style="color: white">@yield('page-title')</h2>
                </div>
                @yield('page-content')
            </div>
            <div>
                @yield('mohtava')
            </div>
        </div>
    </div>    @yield('script')

    @include('layouts.dashboard.footer')


    <!-- JavaScript files-->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.czMore-latest.js') }}"></script>
    <script src="{{ asset('/js/admin.js') }}"></script>

    @yield('script')
</body>

</html>

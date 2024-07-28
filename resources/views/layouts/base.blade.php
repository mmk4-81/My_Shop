<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>@yield('onvan')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('admincss/css/font.css')}}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ url('css/footer.css') }}">
    <link rel="stylesheet" href="{{ url('css/home/categories.css') }}">
    <link rel="stylesheet" href="{{ url('css/home/product.css') }}">
    <link rel="stylesheet" href="{{ url('css/home/shops.css') }}">
    <link rel="stylesheet" href="{{ url('css/cart/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products/products.css') }}">


</head>

<body style="font-family: Vazirmatn, sans-serif">

    @include('layouts.home.navbar')

    @yield('mohtava')

    @include('layouts.home.footer')



    <!-- JavaScript files-->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.czMore-latest.js') }}"></script>

    @yield('script')
</body>

</html>



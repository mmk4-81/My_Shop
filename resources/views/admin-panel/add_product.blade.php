<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <style type="text/css">
        input[type="text"] {
            width: 300px;
            height: 40px !important;
            margin: 10px;
            padding: 5px;
            border-radius: 5px;
            border: none;
        }



        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

    </style>
</head>

<body>
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom" style="color: white">اضافه کردن محصول  </h2>
            </div>
        </div>
        <div>
            <div class="div_deg">
                <form action="{{ url('/admin/upload_product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="group">
                        <label for="title">نام محصول</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="group">
                        <label for="text">توضیحات محصول</label>
                        <textarea name="description" id="text" cols="30" rows="8"></textarea>
                    </div>
                    <div >
                        <label for="img">عکس محصول</label>
                        <input type="file" name="image" id="img">
                    </div>
                    {{-- <div >
                        <label for="category"> دسته بندی محصولات</label>
                        <select name="category" id="category">
                            @foreach ($category as $category )

                            <option value="">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <input type="submit" value="اضافه کردن محصول" class="btn btn-success">
                </form>
            </div>
        </div>

    </div>
    </div>
    <!-- JavaScript files-->

    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
</body>

</html>

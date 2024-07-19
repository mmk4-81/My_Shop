<!-- resources/views/shops/create.blade.php -->
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایجاد فروشگاه جدید</title>
    <!-- شامل فایل‌های CSS و Bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ساخت فروشگاه جدید</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('shops.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="shop_name">نام فروشگاه:</label>
                            <input type="text" id="shop_name" name="shop_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">توضیحات فروشگاه:</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="avatar_shops">تصویر فروشگاه:</label>
                            <input type="file" id="avatar_shops" name="avatar_shops" class="form-control-file">
                        </div>

                        <button type="submit" class="btn btn-primary">ذخیره</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- شامل فایل‌های جاوااسکریپت و Bootstrap -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>

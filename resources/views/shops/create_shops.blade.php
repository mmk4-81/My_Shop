<!-- resources/views/shops/create.blade.php -->
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <title>ایجاد فروشگاه جدید</title>
    <style>
        .box {
            display: flex;
            width: 1000px;
            height: 500px;
            margin: 90px auto;

        }

        .right {
            width: 400px;
            border: 1px solid #fff;
            border-end-start-radius: 10px;

        }

        .left {
            width: 700px;
        }

        img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .title {
            font-size: 24xp;
            font-weight: normal;
            text-align: center;
            margin: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;

        }

        label {
            margin: 10px;
        }

        input[type="text"],
        input[type="file"] {
            width: 80%;
            padding: 10px;
            margin: 0 auto;
            height: 40px;
            border-radius: 8px;
            font-family: 'B Yekan';
            font-size: 16px;

        }

        textarea {
            width: 80%;
            padding: 10px;
            margin: 0 auto;
            height: 80px;
            border-radius: 6px;
            font-size: 16px;
            font-family: 'B Yekan';


        }

        .btn {
            width: 40%;
            padding: 10px;
            background-color: #0077ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 10px auto 20px;
            font-family: 'B Yekan';
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div>

        <div class="box">
            <div class="right">
                <div class="row justify-content-center">
                    <div>
                        <div>
                            <h2 class="title">ساخت فروشگاه جدید</h2>
                            <div class="">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <form action="{{ route('shops.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="shop_name">نام فروشگاه:</label>
                                        <input type="text" id="shop_name" name="shop_name" class="form-control"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">توضیحات فروشگاه:</label>
                                        <textarea id="description" name="description" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="avatar_shops">تصویر فروشگاه:</label>
                                        <input type="file" id="avatar_shops" name="avatar_shops"
                                            class="form-control-file">
                                    </div>

                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="left">
                <img src="{{ asset('image/create-a-shop.jpg') }}" alt="">
            </div>
        </div>
    </div>

</body>

</html>

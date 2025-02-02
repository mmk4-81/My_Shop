@extends('layouts.dashboard')

@section('onvan', 'محصولات')
@section('page-title', 'ایجاد محصول')

@section('mohtava')

<div class="col-xl-12 col-md-12 mb-4 p-4">
    <div class="col-xl-12 col-md-12 mb-4 p-5 ">
        <div class="mb-4 text-center text-md-right">
            <h5 class="font-weight-bold">ویرایش تصاویر محصول : {{ $product->name }}</h5>
        </div>
        <hr>


        <div class="row">
            <div class="col-12 col-md-12 mb-5">
                <h5>تصویر اصلی : </h5>
            </div>
            <div class="col-12 col-md-3 mb-5">
                <div class="card">
                    <img class="card-img-top"
                        src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                        alt="{{ $product->name }}">
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-12 col-md-12 mb-5">
                <h5>تصاویر : </h5>
            </div>
            @foreach ($product->images as $image)
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                            alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <form action="{{ route('seller.products.images.destroy', ['product' => $product->id]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                <button class="btn btn-danger btn-sm mb-3" type="submit">حذف</button>
                            </form>
                            <form action="{{ route('seller.products.images.set_primary', ['product' => $product->id]) }}"
                                method="post">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                <button class="btn btn-primary btn-sm mb-3" type="submit">انتخاب به عنوان تصویر
                                    اصلی</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        <form action="{{ route('seller.products.images.add', ['product' => $product->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="primary_image"> انتخاب تصویر اصلی </label>
                    <div class="custom-file">
                        <input type="file" name="primary_image" class="custom-file-input" id="primary_image">
                        <label class="custom-file-label" for="primary_image"> انتخاب فایل </label>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="images"> انتخاب تصاویر </label>
                    <div class="custom-file">
                        <input type="file" name="images[]" multiple class="custom-file-input" id="images">
                        <label class="custom-file-label" for="images"> انتخاب فایل ها </label>
                    </div>
                </div>
            </div>

            <button class="btn btn-success mt-5" type="submit">ویرایش</button>
            <a href="{{ route('seller.products.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
        </form>
    </div>

</div>

@endsection


@section('script')
    <script>
        $('#primary_image').change(function() {
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#images').change(function() {
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });

    </script>
@endsection

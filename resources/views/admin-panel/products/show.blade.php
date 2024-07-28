@extends('layouts.dashboard')

@section('onvan', 'محصولات')
@section('page-title', 'محصولات')

@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="col-xl-12 col-md-12 mb-4 p-4">
        <div class="mb-4 text-center text-md-right">
            <h5 class="font-weight-bold">محصول: {{ $product->name }}</h5>
        </div>
        <hr>

        <div class="row">
            <div class="form-group col-md-3">
                <label>نام</label>
                <input class="form-control" type="text" value="{{ $product->name }}" disabled>
            </div>
            <div class="form-group col-md-3">
                <label>نام دسته بندی</label>
                <input class="form-control" type="text"
                       value="{{ $product->category->category_name }}{{ $product->category->parent ? ' - ' . $product->category->parent->category_name : '' }}"
                       disabled>
            </div>
            <div class="form-group col-md-3">
                <label>فروشگاه</label>
                <input class="form-control" type="text" value="{{ $product->getShopName() }}" disabled>
            </div>
            <div class="form-group col-md-3">
                <label>وضعیت</label>
                <input class="form-control" type="text" value="{{ $product->is_active == 'فعال' ? 'فعال' : 'غیرفعال' }}" disabled>
            </div>
            <div class="form-group col-md-3">
                <label>تاریخ ایجاد</label>
                <input class="form-control" type="text" value="{{ optional($product->created_at)->format('Y-m-d H:i:s') ?? 'تاریخ نامشخص' }}" disabled>
            </div>

            <div class="form-group col-md-12">
                <label>توضیحات</label>
                <textarea class="form-control" rows="3" disabled>{{ $product->description }}</textarea>
            </div>

            {{-- Attributes & Variations --}}
            <div class="col-md-12">
                <hr>
                <p>ویژگی‌ها:</p>
            </div>
            @if(isset($productAttributes) && $productAttributes->isNotEmpty())
            @foreach ($productAttributes as $productAttribute)
                <div class="form-group col-md-3">
                    <label>{{ $productAttribute->attribute->name }}</label>
                    <input class="form-control" type="text" value="{{ $productAttribute->value }}" disabled>
                </div>
            @endforeach
        @else
            <p>ویژگی‌ها یافت نشدند.</p>
        @endif

        @if(isset($productVariations) && $productVariations->isNotEmpty())
            @foreach ($productVariations as $variation)
                <div class="col-md-12">
                    <hr>
                    <div class="d-flex">
                        <p class="mb-0">قیمت و موجودی برای متغیر ({{ $variation->value }}):</p>
                        <p class="mb-0 mr-3">
                            <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapse-{{ $variation->id }}">
                                نمایش
                            </button>
                        </p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="collapse mt-2" id="collapse-{{ $variation->id }}">
                        <div class="card card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>قیمت</label>
                                    <input type="text" disabled class="form-control" value="{{ $variation->price }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>تعداد</label>
                                    <input type="text" disabled class="form-control" value="{{ $variation->quantity }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>متغیرها یافت نشدند.</p>
        @endif

        <div class="image_containers">
            <img class="card-img-top2" src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}" alt="{{ $product->name }}">
            @if(isset($images) && $images->isNotEmpty())
                @foreach ($images as $image)
                    <div class="col-md-3 imagess">
                        <div class="card">
                            <img class="card-img-top" src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}" alt="{{ $product->name }}">
                        </div>
                    </div>
                @endforeach
            @else
                <p>تصویری یافت نشد.</p>
            @endif
        </div>

        </div>

        <a href="{{ route('admin.products.index') }}" class="btn btn-danger mt-5">بازگشت</a>
    </div>
</div>
@endsection

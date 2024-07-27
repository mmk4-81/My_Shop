@extends('layouts.dashboard')

@section('onvan', 'محصولات')

@section('mohtava')

<div class="col-xl-12 col-md-12 mb-4 p-4">
    <div class="col-xl-12 col-md-12 mb-4 p-4">
        <div class="mb-4 text-center text-md-right">
            <h5 class="font-weight-bold">ویرایش محصول {{ $product->name }}</h5>
        </div>
        <hr>

        <form action="{{ route('seller.products.update', ['product' => $product->id]) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-row">

                <div class="form-group col-md-3">
                    <label for="name">نام</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{ $product->name }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="slug">اسلاگ</label>
                    <input class="form-control" id="slug" name="slug" type="text" value="{{ $product->slug }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="is_active">وضعیت</label>
                    <select class="form-control" id="is_active" name="is_active">
                        <option value="1" {{ $product->getRawOriginal('is_active') ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ !$product->getRawOriginal('is_active') ? 'selected' : '' }}>غیرفعال</option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ $product->description }}</textarea>
                </div>
            </div>

            <button class="btn btn-info mt-5" type="submit">ویرایش</button>
            <a href="{{ route('seller.products.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
        </form>

        <form id="delete-product-form-{{ $product->id }}" action="{{ route('seller.products.destroy', ['product' => $product->id]) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <a href="#" class="btn btn-danger mt-5 mr-3" onclick="event.preventDefault(); document.getElementById('delete-product-form-{{ $product->id }}').submit();">
            حذف محصول
        </a>
    </div>
</div>

@endsection

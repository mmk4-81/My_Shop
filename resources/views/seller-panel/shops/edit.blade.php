@extends('layouts.dashboard')

@section('onvan', 'ویرایش فروشگاه من')

@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="mb-4">
        <h5 class="font-weight-bold">ویرایش فروشگاه من: {{ $shop->shop_name }}</h5>
    </div>
    <hr>

    <form action="{{ route('seller.myshop.update', ['myshop' => $shop->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="name">نام</label>
                <input class="form-control" id="name" name="shop_name" type="text" value="{{ $shop->shop_name }}">
            </div>
            <div class="form-group col-md-6">
                <label for="description">توضیحات</label>
                <textarea class="form-control" id="description" name="description">{{ $shop->description }}</textarea>
            </div>
            <div class="form-group col-md-3">
                <label for="avatar">تصویر فروشگاه</label>
                <input class="form-control" id="avatar" name="avatar_shops" type="file">
            </div>
        </div>

        <button class="btn btn-success mt-5" type="submit">ویرایش</button>
        <a href="{{ route('seller.myshop.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
    </form>
</div>
@endsection

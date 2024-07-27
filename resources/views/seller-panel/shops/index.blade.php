@extends('layouts.dashboard')

@section('onvan', 'فروشگاه من')

@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="mb-4">
        <h5 class="font-weight-bold">فروشگاه من: {{ $shop->shop_name }}</h5>
    </div>
    <hr>



    <div class="sidebar-header d-flex ">
        <div class="form-group col-md-3 avatar">
            <label>تصویر فروشگاه:</label>
            @if($shop->avatar_shops)
                <img src="{{ asset('uploads/avatars/shops/' . $shop->avatar_shops) }}"  alt="Shop Avatar" width="100px" class="img-thumbnail">
            @else
                <p>تصویری موجود نیست</p>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label>توضیحات:</label>
            <p>{{ $shop->description }}</p>
        </div>
    </div>

    <a href="{{ route('seller.myshop.edit', ['myshop' => $shop->id]) }}" class="btn btn-primary mt-3">ویرایش</a>

    <form action="{{ route('seller.myshop.destroy', ['myshop' => $shop->id]) }}" method="POST" id="delete-form" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger mt-3" type="submit">حذف فروشگاه</button>
    </form>



</div>
@endsection

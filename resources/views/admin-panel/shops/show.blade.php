@extends('layouts.dashboard')

@section('onvan', 'نمایش فروشگاه')
{{-- @section('page-title', '  ا') --}}
{{-- @section('role', $user->hasRole('admin') ? 'ادمین ' : 'فروشنده ')
@section('user-role', $user->hasRole('admin') ? 'ادمین سایت' : 'فروشنده سایت') --}}



@section('mohtava')

    <div class="col-xl-12 col-md-12 mb-4 p-md-5 ">
        <div class="mb-4">
            <h5 class="font-weight-bold">فروشگاه : {{ $shop->name }}</h5>
        </div>
        <hr>

        <div class="row">
            <div class="form-group col-md-4">
                <label>نام فروشگاه:</label>
                <input class="form-control" type="text" value="{{ $shop->shop_name }}" disabled>
            </div>
            <div class="form-group col-md-4">
                <label>نام صاحب فروشگاه:</label>
                <input class="form-control" type="text" value="{{ $shop->user->name }}" disabled>
            </div>
            <div class="form-group col-md-8">
                <label>توضیحات فروشگاه:</label>
                <textarea class="form-control" disabled>{{ $shop->description }}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label>آواتار فروشگاه:</label>
                @if ($shop->avatar_shops)
                    <img src="{{ asset('/uploads/avatars/shops/' . $shop->avatar_shops) }}" class="img-fluid" alt="آواتار فروشگاه">
                @else
                    <p>بدون آواتار</p>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label>تاریخ ایجاد:</label>
                <input class="form-control" type="text" value="{{ verta($shop->created_at) }}" disabled>
            </div>
        </div>

        <a href="{{ route('admin.shops.index') }}" class="btn btn-danger mt-5">بازگشت</a>

    </div>

@endsection

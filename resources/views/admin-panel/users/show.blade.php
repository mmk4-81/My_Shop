@extends('layouts.dashboard')

@section('onvan', 'نمایش کاربر')
@section('page-title', 'نمایش کاربر')

@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <div class="mb-4">
        <h5 class="font-weight-bold">کاربر: {{ $user->name }}</h5>
    </div>
    <hr>

    <div class="row">
        <div class="form-group col-md-3">
            <label>نام</label>
            <input class="form-control" type="text" value="{{ $user->name }}" disabled>
        </div>
        <div class="form-group col-md-3">
            <label>ایمیل</label>
            <input class="form-control" type="text" value="{{ $user->email }}" disabled>
        </div>
        <div class="form-group col-md-3">
            <label>تلفن</label>
            <input class="form-control" type="text" value="{{ $user->phone }}" disabled>
        </div>
        <div class="form-group col-md-3">
            <label>آدرس</label>
            <input class="form-control" type="text" value="{{ $user->address }}" disabled>
        </div>
        <div class="form-group col-md-3">
            <label>نقش</label>
            <input class="form-control" type="text" value="{{ $user->roles->pluck('name')->join(', ') }}" disabled>
        </div>
        <div class="form-group col-md-3">
            <label>اعتبار</label>
            <input class="form-control" type="text" value="{{ $user->credit }}" disabled>
        </div>
        <div class="form-group col-md-3">
            <label>تاریخ ایجاد</label>
            <input class="form-control" type="text" value="{{ verta($user->created_at) }}" disabled>
        </div>
        <div class="form-group col-md-3">
            <label>آواتار</label>
            <div>
                <img src="{{ asset('/uploads/avatars/' . $user->avatar) }}" width="200px" alt="{{ $user->name }}">
            </div>
        </div>
    </div>

    <a href="{{ route('admin.users.index') }}" class="btn btn-danger mt-5">بازگشت</a>
</div>
@endsection

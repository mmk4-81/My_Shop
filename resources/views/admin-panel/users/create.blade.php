@extends('layouts.dashboard')

@section('onvan', 'ایجاد کاربر')
@section('page-title', 'ایجاد کاربر')

@section('mohtava')
<div class="col-xl-12 col-md-12 mb-4 p-md-5">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name">نام:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="email">ایمیل:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group col-md-4">
                <label for="password">رمز عبور:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group col-md-4">
                <label for="password_confirmation">تأیید رمز عبور:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="form-group col-md-4">
                <label for="phone">تلفن:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group col-md-4">
                <label for="avatar">آواتار:</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
            </div>
            <div class="form-group col-md-4">
                <label for="credit">اعتبار:</label>
                <input type="text" class="form-control" id="credit" name="credit" required>
            </div>
            <div class="form-group col-md-4">
                <label for="role">نقش:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="user">کاربر</option>
                    <option value="admin">مدیر</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="address">آدرس:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
        </div>

        <button class="btn btn-success mt-5" type="submit">ثبت</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
    </form>
</div>
@endsection

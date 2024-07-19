@extends('layouts.dashboard')

@section('onvan', 'اضافه کردن کاربر')
@section('page-title', ' اضافه کردن کاربر')
@section('role', 'ادمین')
@section('user-role', 'ادمین سایت')

@section('mohtava')
<div class="form-container">
    <form action="{{ route('admin.store_user') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="name">نام:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">ایمیل:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">رمز عبور:</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">تأیید رمز عبور:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <label for="phone">تلفن:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="avatar">آواتار:</label>
        <input type="file" id="avatar" name="avatar">

        <label for="credit">اعتبار:</label>
        <input type="text" id="credit" name="credit" required>

        <label for="role">نقش:</label>
        <select id="role" name="role" required>
            <option value="user">کاربر</option>
            <option value="admin">مدیر</option>
        </select>

        <label for="address">آدرس:</label>
        <input type="text" id="address" name="address" required>

        <input type="submit" value="اضافه کردن" class="btn btn-primary">
    </form>
</div>
@endsection



@extends('layouts.dashboard')

@section('onvan', 'ویرایش کردن کاربر')
@section('page-title', 'ویرایش کردن کاربر')
{{-- @section('role', 'ادمین')
@section('user-role', 'ادمین سایت') --}}

@section('mohtava')
<div class="form-container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">نام:</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">ایمیل:</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone">تلفن:</label>
            <input type="text" name="phone" value="{{ $user->phone }}" required>
        </div>
        <div class="form-group">
            <label for="address">آدرس:</label>
            <input type="text" name="address" value="{{ $user->address }}">
        </div>
        <div class="form-group">
            <label for="avatar">آواتار:</label>
            <input type="file" name="avatar">
            @if ($user->avatar)
                <img src="{{ asset('uploads/avatars/' . $user->avatar) }}" height="100px" alt="آواتار فعلی">
            @endif
        </div>
        <input type="submit" value="ذخیره" class="btn btn-primary">
        <a href="{{ url('/admin/view_users') }}" class="btn btn-danger">لغو</a>
    </form>
</div>
@endsection

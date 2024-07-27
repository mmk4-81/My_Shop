@extends('layouts.dashboard')

@section('onvan', 'داشبورد')
@section('page-title', 'داشبورد')
@section('role', $user->hasRole('admin') ? 'ادمین ' : 'فروشنده ')
@section('user-role', $user->hasRole('admin') ? 'ادمین سایت' : 'فروشنده سایت')

@section('mohtava')
<div id="mohtava-container" class="container p-4 rounded " >
    <h1 style="margin-bottom: 30px">به داشبورد وبسایت خوش آمدید</h1>
    <p>در اینجا می‌توانید به اطلاعات و مدیریت مختلف دسترسی پیدا کنید. از منوی سایدبار، به بخش‌های مختلف داشبورد دسترسی پیدا کنید و عملیات مورد نظر خود را انجام دهید.</p>
    <p>برای شروع، می‌توانید به بخش‌های مانند "مدیریت کاربران"، "مدیریت محصولات" و "فروشگاه ها" مراجعه کنید.</p>
</div>
@endsection

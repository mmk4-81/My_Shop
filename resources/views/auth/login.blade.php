<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/login.css') }}">

    <title>Login</title>

</head>

<body>
    <div class="box">
        <div class="title">ورود به حساب کاربری</div>
        <form method="POST" action="{{ route('login') }}" class="auth-login-form">
            @csrf

            <!-- Email Address -->
            <div class="form">
                <x-input-label for="email" class="lable" :value="__('ایمیل')" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="text-danger" />
            </div>

            <!-- Password -->
            <div class="form">
                <x-input-label for="password" class="lable" :value="__('رمز عبور')" />
                <x-text-input id="password" class="form-control" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="text-danger" />
            </div>

            <!-- Remember Me -->
            <div class="form-check">
                <label for="remember_me" class="form-check-label">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <span>{{ __('مرا به خاطر بسپار') }}</span>
                </label>
            </div>
            <button class="submit" type="submit" class="btn">
                <p>{{ __(' ورود') }}</p>
            </button>

            <div class="btnlogin">
                @if (Route::has('password.request'))
                    <a class="forget" href="{{ route('password.request') }}">
                        {{ __('آیا رمز عبور را فراموش کرده اید؟') }}
                    </a>
                @endif
                <a class="forget" href="{{ route('register') }}">
                    {{ __('ثبت نام نکرده اید؟') }}
                </a>


            </div>
        </form>
        {{-- <a class="back" href="{{ url('/') }}">
            {{ __('برگشت به صفحه اصلی') }}
        </a> --}}
    </div>
</body>

</html>

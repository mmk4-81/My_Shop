<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/login.css') }}">

    <title>Register</title>

</head>

<body>
    <div class="box-r">
        <div class="title-r">ثبت نام</div>
        <form method="POST" action="{{ route('register') }}" class="auth-register-form">
            @csrf

            <!-- Name -->
            <div class="form">
                <x-input-label for="name" class="lable" :value="__('نام و نام خانوادگی')" />
                <x-text-input id="name" class="form-controlr" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="text-danger" />
            </div>

            <!-- Email Address -->
            <div class="form">
                <x-input-label for="email" class="lable" :value="__('ایمیل')" />
                <x-text-input id="email" class="form-controlr" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="text-danger" />
            </div>

            <!-- Phone -->
            <div class="form">
                <x-input-label for="phone" class="lable" :value="__('تلفن')" />
                <x-text-input id="phone" class="form-controlr" type="text" name="phone" :value="old('phone')" required autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone')" class="text-danger" />
            </div>

            <!-- Password -->
            <div class="form">
                <x-input-label for="password" class="lable" :value="__('رمز عبور')" />
                <x-text-input id="password" class="form-controlr" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="text-danger" />
            </div>

            <!-- Confirm Password -->
            <div class="form">
                <x-input-label for="password_confirmation" class="lable" :value="__('تایید رمز عبور')" />
                <x-text-input id="password_confirmation" class="form-controlr" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
            </div>

            <button type="submit" class="btn">
                <p>{{ __('ثبت نام') }}</p>
            </button>

            <div class="btnlogin">
                <a class="forget" href="{{ route('login') }}">
                    {{ __('ثبت نام کرده اید؟') }}
                </a>
            </div>
        </form>
    </div>
</body>

</html>

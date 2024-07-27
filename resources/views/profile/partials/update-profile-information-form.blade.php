<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <title>اطلاعات پروفایل</title>
</head>

<body class="bg-dark text-white">
    <section >
        <header>
            <h2 class="text-lg font-medium text-white">
                اطلاعات پروفایل
            </h2>

            <p class="mt-1 text-sm text-white">
                اطلاعات پروفایل، آدرس ایمیل، آواتار، شماره تلفن و آدرس حساب خود را به‌روزرسانی کنید.
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form id="profile-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('patch')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-input-label for="name" :value="__('نام')" class="text-white" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-dark" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2 text-white" :messages="$errors->get('name')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="email" :value="__('ایمیل')" class="text-white" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full text-dark" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2 text-white" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-white">
                                آدرس ایمیل شما تأیید نشده است.

                                <button form="send-verification" class="underline text-sm text-white hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    برای ارسال مجدد ایمیل تأیید اینجا کلیک کنید.
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-400">
                                    یک لینک تأیید جدید به آدرس ایمیل شما ارسال شده است.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="phone" :value="__('تلفن همراه')" class="text-white" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full text-dark" :value="old('phone', $user->phone)" required autocomplete="phone" />
                    <x-input-error class="mt-2 text-white" :messages="$errors->get('phone')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="address" :value="__('آدرس')" class="text-white" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full text-dark" :value="old('address', $user->address)" required autocomplete="address" />
                    <x-input-error class="mt-2 text-white" :messages="$errors->get('address')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="avatar" :value="__('آواتار')" class="text-white" />
                    <x-text-input aria-placeholder="تغییر پروفایل" id="avatar" name="avatar" type="file" class="mt-1 block w-full text-dark" />
                    <x-input-error class="mt-2 text-white" :messages="$errors->get('avatar')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="credit" :value="__('اعتبار')" class="text-white" />
                    <x-text-input id="credit" name="credit" type="text" class="mt-1 block w-full text-dark" :value="$user->credit" readonly />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="roles" :value="__('نقش‌ها')" class="text-white" />
                    <x-text-input id="roles" name="roles" type="text" class="mt-1 block w-full text-dark" :value="$user->roles()->pluck('name')->implode(', ')" readonly />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>ذخیره</x-primary-button>
                <button type="button" onclick="resetForm()" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    کنسل
                </button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-white"
                    >ذخیره شد.</p>
                @endif
            </div>
        </form>
    </section>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function resetForm() {
            document.getElementById('profile-form').reset();
        }
    </script>
</body>

</html>

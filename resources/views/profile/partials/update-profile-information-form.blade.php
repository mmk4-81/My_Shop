<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            اطلاعات پروفایل
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            اطلاعات پروفایل، آدرس ایمیل، آواتار، شماره تلفن و آدرس حساب خود را به‌روزرسانی کنید.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="profile-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('نام')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('ایمیل')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        آدرس ایمیل شما تأیید نشده است.

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            برای ارسال مجدد ایمیل تأیید اینجا کلیک کنید.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            یک لینک تأیید جدید به آدرس ایمیل شما ارسال شده است.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="phone" :value="__('تلفن همراه')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('آدرس')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" required autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="avatar" :value="__('آواتار')" />
            <x-text-input aria-placeholder="تغییر پروفایل" id="avatar" name="avatar" type="file" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <!-- Display credit and role -->
        <div>
            <x-input-label for="credit" :value="__('اعتبار')" />
            <x-text-input id="credit" name="credit" type="text" class="mt-1 block w-full" :value="$user->credit" readonly />
        </div>
        <div>
            <x-input-label for="roles" :value="__('نقش‌ها')" />
            <x-text-input id="roles" name="roles" type="text" class="mt-1 block w-full" :value="$user->roles()->pluck('name')->implode(', ')" readonly />
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
                    class="text-sm text-gray-600 dark:text-gray-400"
                >ذخیره شد.</p>
            @endif
        </div>
    </form>
</section>

<script>
    function resetForm() {
        document.getElementById('profile-form').reset();
    }
</script>

<section>
    <header>
        <h2 class="text-lg font-medium text-white dark:text-white">
            {{ __('بروزرسانی رمز عبور') }}
        </h2>

        <p class="mt-1 text-sm text-white dark:text-white">
            {{ __('اطمینان حاصل کنید که حساب شما از یک رمز عبور طولانی و تصادفی برای حفظ امنیت استفاده می‌کند.') }}
        </p>
    </header>

    <form id="password-form" method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('رمز عبور فعلی')" class="text-white" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-white" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('رمز عبور جدید')" class="text-white" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-white" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('تایید رمز عبور')" class="text-white" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-white" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('ذخیره') }}</x-primary-button>
            <button type="button" onclick="resetPasswordForm()" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                {{ __('کنسل') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-white dark:text-white"
                >{{ __('ذخیره شد.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function resetPasswordForm() {
        document.getElementById('password-form').reset();
    }
</script>

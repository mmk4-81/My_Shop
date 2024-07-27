<section class="space-y-6 text-white">
    <header>
        <h2 class="text-lg font-medium">
            {{ __('حذف حساب کاربری') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('پس از حذف حساب کاربری، تمامی منابع و داده‌های آن به طور دائمی حذف خواهند شد. قبل از حذف حساب کاربری، لطفاً هر داده یا اطلاعاتی که می‌خواهید نگه دارید را دانلود کنید.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 text-white hover:bg-red-500"
    >
        {{ __('حذف حساب کاربری') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gray-800">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium">
                {{ __('آیا مطمئن هستید که می‌خواهید حساب کاربری خود را حذف کنید؟') }}
            </h2>

            <p class="mt-1 text-sm">
                {{ __('پس از حذف حساب کاربری، تمامی منابع و داده‌های آن به طور دائمی حذف خواهند شد. لطفاً برای تأیید حذف دائمی حساب کاربری خود، رمز عبور خود را وارد کنید.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('رمز عبور') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 bg-gray-700 text-white"
                    placeholder="{{ __('رمز عبور') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="bg-gray-600 text-white hover:bg-gray-500">
                    {{ __('لغو') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 bg-red-600 text-white hover:bg-red-500">
                    {{ __('حذف حساب کاربری') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

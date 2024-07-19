<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('با تشکر از ثبت نام شما! قبل از شروع، آیا می‌توانید آدرس ایمیل خود را تأیید کنید؟ لطفاً بر روی لینکی که به شما ایمیل شده، کلیک کنید. اگر ایمیل را دریافت نکردید، ما با خوشی یکی دیگر برای شما ارسال می‌کنیم.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('یک لینک جدید برای تأیید به آدرس ایمیلی که در هنگام ثبت نام ارائه داده‌اید، ارسال شده است.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('ارسال مجدد ایمیل تأیید') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('خروج از حساب کاربری') }}
            </button>
        </form>
    </div>
</x-guest-layout>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div style="display: flex; justify-content: space-between; gap: 20px;">
                <!-- سمت راست که شامل بخش اطلاعات پروفایل است -->
                <div style="width: 50%;" class="p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- سمت چپ که شامل دو بخش ستونی است -->
                <div style="width: 45%; display: flex; flex-direction: column; gap: 20px;">
                    <!-- بخش تغییر رمز عبور -->
                    <div class="p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                    <!-- بخش حذف کاربر -->
                    <div class="p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

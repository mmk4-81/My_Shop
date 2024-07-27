<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>پنل کاربری</title>
    <style>
        .custom-nav {
            border-bottom: 1px solid #e5e7eb;
        }

        .dropdown-trigger button {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        .dropdown-trigger img {
            margin-left: 10px;
        }

        .nav-title {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .custom-button {
            background-color: #0077ff;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin: 0 0.5rem;
            text-decoration: none;
        }

        .custom-button:hover {
            background-color: #005bb5;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #0f172a;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            color: white;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover,
        .dropdown-content button:hover {
            background-color: #005bb5;
        }

        .show {
            display: block;
        }
    </style>
</head>

<body>
    <nav class="custom-nav border-b dark:bg-gray-800 border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Settings Dropdown -->
                <div class="dropdown-trigger relative">
                    <button onclick="toggleDropdown()">
                        <img height="40px" width="40px" src="{{ Auth::user()->avatar_url }}" alt="avatar" class="h-10 w-10 rounded-full object-cover">
                        <div>{{ Auth::user()->name }}</div>

                        <svg class="fill-current h-4 w-4 ms-2" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="dropdown-content" class="dropdown-content">
                        @if (Auth::user()->hasRole('seller'))
                        <a href="{{ url('seller-panel/dashboard') }}">{{ __('پنل فروشگاه') }}</a>
                        @endif
                        @if (Auth::user()->hasRole('admin'))
                        <a href="{{ url('admin-panel/dashboard') }}">{{ __('پنل ادمین') }}</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">{{ __('خروج از حساب کاربری') }}</button>
                        </form>
                    </div>
                </div>

                <h2 class="nav-title font-semibold text-xl text-gray-800 dark:text-gray-200">
                    {{ __('پنل کاربری') }}
                </h2>

                <div class="flex items-center">
                    @unless (Auth::user()->hasRole('seller'))
                    <a class="custom-button" href="{{ url('/shops/create') }}">ساخت فروشگاه</a>
                    @endunless
                    <a class="custom-button" href="{{ url('/') }}">برگشت به صفحه اصلی</a>
                </div>
            </div>
        </div>
    </nav>

    <script>
        function toggleDropdown() {
            document.getElementById("dropdown-content").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-trigger button') &&
                !event.target.matches('.dropdown-trigger button *')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">

    <title>Home</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body>

    <!-- Navbar -->
    @if (Route::has('login'))
        <nav class="bg-black text-white p-4 flex justify-between items-center fixed rounded-xl m-10 w-6/12 z-10">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" />
            </a>

            <ul class="flex space-x-6">
                @auth
                    <li>
                        <a href="{{ url('/dashboard') }}" class="hover:text-yellow-400">
                            Home
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/menu') }}" class="hover:text-yellow-400">
                            Menu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="hover:text-yellow-400">
                            Log in
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}" class="hover:text-yellow-400">
                                Register
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>
    @endif

    <!-- Hero Section -->
    <section class="flex flex-col md:flex-row h-screen">
        <!-- Kolom Kiri -->
        <div class="w-full md:w-8/12 flex justify-center items-center">
            <img src="{{ asset('img/bg-rames.png') }}" class="h-full w-full object-cover" alt="Background"></img>
        </div>
        <!-- Kolom Kanan -->
        <div class="w-full md:w-1/2 grid grid-rows-3">
            <!-- Menu Image -->
            <div class="relative group">
                <img src="{{ asset('img/Menu.png') }}" alt="Menu" class="h-full w-full object-cover">
                <button"
                    class="absolute inset-0 bg-gray-300 bg-opacity-70 text-yellow-400 text-lg font-bold flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                    MENU
                    </button>
            </div>
            <!-- Order Image -->
            <div class="relative group">
                <img src="{{ asset('img/ORDER.png') }}" alt="Order" class="h-full w-full object-cover">
                <button"
                    class="absolute inset-0 bg-gray-300 bg-opacity-70 text-yellow-400 text-lg font-bold  flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                    ORDER
                    </button>
            </div>
            <!-- Resto Image -->
            <div class="relative group">
                <img src="{{ asset('img/RESTO.png') }}" alt="Resto" class="h-full w-full object-cover">
                <button"
                    class="absolute inset-0 bg-gray-300 bg-opacity-70 text-yellow-400 text-lg font-bold flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                    RESTO
                    </button>
            </div>
        </div>
    </section>
</body>

</html>

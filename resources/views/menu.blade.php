<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Menu</title>
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
    <section class="flex flex-col md:flex-row h-screen" x-data="{
        activeMenu: 'menuHarian',
        menus: {
            menuHarian: '{{ asset('img/bg-menuharian.png') }}',
            menuSpesial: '{{ asset('img/bg-menuspesial.png') }}',
            paket: '{{ asset('img/bg-menupaket.png') }}',
            bungkus: '{{ asset('img/bg-menubungkus.png') }}'
        },
        menuItems: {
            menuHarian: '{{ asset('img/content-menuharian.png') }}',
            menuSpesial: '{{ asset('img/content-menuspesial.png') }}',
            paket: '{{ asset('img/content-menupaket.png') }}',
            bungkus: '{{ asset('img/content-menubungkus.png') }}'
        },
        menuBackgrounds: {
            menuHarian: 'bg-[#522c2d]',
            menuSpesial: 'bg-[#524522]',
            paket: 'bg-[#522c2d]',
            bungkus: 'bg-[#524522]'
        }
    }">
        <!-- Kolom Kiri -->
        <div class="w-full md:w-8/12 flex justify-center items-center h-full">
            <img :src="menus[activeMenu]" class="h-full w-full object-fill transition duration-300" alt="Background">
        </div>

        <!-- Kolom Kanan -->
        <div class="w-full md:w-5/12 flex flex-col relative z-20 h-full">
            <div class="flex flex-row space-x-2 p-10">
                <button @click="activeMenu = 'menuHarian'"
                    class="w-10/12 p-2 bg-transparent border border-white text-sm text-white font-normal rounded-lg hover:bg-white hover:text-black transition duration-300">
                    MENU HARIAN
                </button>
                <button @click="activeMenu = 'menuSpesial'"
                    class="w-10/12 p-2 bg-transparent border border-white text-sm text-white font-normal rounded-lg hover:bg-white hover:text-black transition duration-300">
                    MENU SPESIAL
                </button>
                <button @click="activeMenu = 'paket'"
                    class="w-3/12 p-2 bg-transparent border border-white text-sm text-white font-normal rounded-lg hover:bg-white hover:text-black transition duration-300">
                    PAKET
                </button>
                <button @click="activeMenu = 'bungkus'"
                    class="w-5/12 p-2 bg-transparent border border-white text-sm text-white font-normal rounded-lg hover:bg-white hover:text-black transition duration-300">
                    BUNGKUS
                </button>
            </div>

            <!-- Menu Items -->
            <div :class="menuBackgrounds[activeMenu]"
                class="absolute inset-0 w-full h-full pt-[6rem] px-[6rem] pb-5 -z-10">
                <img :src="menuItems[activeMenu]" class="h-full w-full object-fill transition duration-300"
                    alt="Background">
            </div>
        </div>
    </section>
</body>

</html>

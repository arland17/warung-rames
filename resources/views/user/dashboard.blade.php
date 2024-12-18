<x-user-layout>

    {{-- SECTION 1 --}}
    <section class="relative bg-cover bg-center object-fill h-screen"
        style="background-image: url('{{ asset('img/bg-section.png') }}');">
        <div class="flex h-full items-center justify-between px-16">
            <!-- Left content -->
            <div class="flex flex-col justify-center w-1/2 text-black max-w-lg space-y-4">
                <h1 class="text-5xl font-bold leading-10">Warung Rame's</h1>
                <p class="text-5xl font-bold leading-10">SEDJAK 2020</p>
                <div class="flex flex-row">
                    <button
                        class="bg-black text-white mt-20 py-2 px-6 rounded-2xl font-semibold hover:bg-yellow-500 hover:text-black w-40 transition">
                        Order Now
                    </button>
                </div>
            </div>

            <!-- Right content: Image carousel -->
            <div class="w-1/2 relative overflow-hidden">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide p-5">
                            <img src="{{ asset('img/carousel-2.jpeg') }}" alt="Image 2"
                                class="w-full h-auto object-cover border rounded-lg transition-transform duration-500">
                        </div>
                        <div class="swiper-slide p-5">
                            <img src="{{ asset('img/carousel-3.jpeg') }}" alt="Image 3"
                                class="w-full h-auto object-cover border rounded-lg transition-transform duration-500">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2 --}}
    <section class="py-8 px-4 md:px-8 bg-white">
        <div class="container mx-auto">
            <!-- Header Section -->
            <h1 class="text-4xl md:py-4 font-extrabold text-gray-800">Menu</h1>

            <!-- Alpine.js Data and Button Row -->
            <div x-data="{ showPaket: true, showBungkus: false }">
                <!-- Button Row -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex gap-2">
                        <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition-all"
                            :class="{ 'bg-yellow-500 text-white': showBungkus }"
                            @click="showBungkus = true; showPaket = false">
                            Bungkus
                        </button>
                        <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition-all"
                            :class="{ 'bg-yellow-500 text-white': showPaket }"
                            @click="showPaket = true; showBungkus = false">
                            Paket
                        </button>
                    </div>
                </div>

                <!-- Categories and Menu Items -->
                <!-- Bungkus Menu -->
                <div x-show="showBungkus" x-transition>
                    <div class="mb-6">
                        <!-- Header untuk Paket Menu -->
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Paket Menu</h2>

                        <!-- Menu Items Grid for Paket -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
                            @foreach ($stocksBungkus as $stock)
                                <div
                                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition transform hover:scale-105">
                                    <img src="{{ $stock->image ? asset('storage/' . $stock->image) : 'https://via.placeholder.com/300' }}"
                                        alt="Menu Item" class="w-full h-40 object-cover" />
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                            {{ $stock->product_name }}
                                        </h3>
                                        <p class="text-gray-600 text-sm mb-4">
                                            {{ $stock->description }}
                                        </p>
                                        <div class="flex justify-between items-center">
                                            <span class="text-yellow-500 font-bold text-lg">
                                                {{ number_format($stock->price, 0, ',', '.') }}
                                            </span>

                                            <a href="{{ route('add.to.cart', $stock->id) }}"
                                                class="bg-yellow-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
                                                +
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Paket Menu -->
                <div x-show="showPaket" x-transition>
                    @foreach (['Nasi Sayur', 'Nasi Telur', 'Nasi Lauk'] as $category_paket)
                        <div class="mb-6">
                            <!-- Category Title -->
                            <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $category_paket }}</h2>

                            <!-- Menu Items Grid for Paket -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                                @foreach ($stocksPaket->where('category_paket', $category_paket) as $stock)
                                    <div
                                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition transform hover:scale-105">
                                        <img src="{{ $stock->image ? asset('storage/' . $stock->image) : 'https://via.placeholder.com/300' }}"
                                            alt="Menu Item" class="w-full h-40 object-cover" />
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                                {{ $stock->product_name }}
                                            </h3>
                                            <p class="text-gray-600 text-sm mb-4">
                                                {{ $stock->description }}
                                            </p>
                                            <div class="flex justify-between items-center">
                                                <span class="text-yellow-500 font-bold text-lg">
                                                    {{ number_format($stock->price, 0, ',', '.') }}
                                                </span>
                                                <a href="{{ route('add.to.cart', $stock->id) }}"
                                                    class="bg-yellow-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
                                                    +
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <script>
        // Initialize Swiper
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            effect: 'slide',
            autoplay: {
                delay: 3000,
            },
            slideToClickedSlide: true,
            // Custom animation for slide transition
            on: {
                slideChangeTransitionStart: function() {
                    const slides = document.querySelectorAll('.swiper-slide img');
                    slides.forEach(slide => {
                        slide.classList.add('scale-75',
                            'translate-x-10'); // Start with small and pushed to the right
                    });
                },
                slideChangeTransitionEnd: function() {
                    const activeSlide = document.querySelector('.swiper-slide-active img');
                    activeSlide.classList.remove('scale-75', 'translate-x-10');
                    activeSlide.classList.add('scale-100',
                        'translate-x-0'); // Make active image big and in original position
                }
            },
        });
    </script>

    <script>
        function addToCart(productId) {
            fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.cart) {
                        updateCartDropdown(data.cart); // Perbarui tampilan keranjang secara dinamis
                    }
                });
        }
    </script>


</x-user-layout>

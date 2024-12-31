<nav x-data="{ open: false }" class="bg-white border-gray-100 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('user.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-black" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.order')" :active="request()->routeIs('user.order')">
                        {{ __('Order') }}
                    </x-nav-link>
                    <x-nav-link :href="route('order.details')" :active="request()->routeIs('order.details')">
                        {{ __('History') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Cart and Profile Dropdowns -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 ">
                <!-- Cart Dropdown -->
                <x-dropdown align="right" width="0">
                    <x-slot name="trigger">
                        <button
                            class="relative inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-white hover:text-gray-500 focus:outline-none transition ease-in-out duration-150">
                            <div class="ms-1 mr-1 size-6">
                                <img src="{{ asset('img/icon-cart.png') }}" alt="Cart" />
                            </div>
                            <!-- Red Circle Notification -->
                            @if ($cartItemCount > 0)
                                <div
                                    class="absolute top-2 right-0 mr-1 translate-x-1/2 -translate-y-1/2 bg-red-500 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">
                                    {{ $cartItemCount }} <!-- Display the cart item count -->
                                </div>
                            @endif
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="w-[28rem] bg-white rounded-lg shadow-lg">
                            <!-- Header -->
                            <div class="p-4 border-b">
                                <h3 class="font-bold text-lg">Keranjang</h3>
                            </div>

                            <!-- Cart Items -->
                            <div class="max-h-60 overflow-y-auto">
                                @forelse ($cartItems as $item)
                                    <div class="flex items-center justify-between p-4 border-b">
                                        <!-- Decrease Button -->
                                        <form action="{{ route('cart.decrease', $item->carts_id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-6 h-6 bg-gray-200 rounded text-black font-bold hover:bg-gray-300 flex items-center justify-center">
                                                -
                                            </button>
                                        </form>

                                        <!-- Quantity -->
                                        <span class="text-sm font-medium">{{ $item->quantity }}</span>

                                        <!-- Increase Button -->
                                        <form action="{{ route('cart.increase', $item->carts_id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-6 h-6 bg-gray-200 rounded text-black font-bold hover:bg-gray-300 flex items-center justify-center">
                                                +
                                            </button>
                                        </form>


                                        <!-- Product Image and Info -->
                                        <div class="flex items-center">
                                            <img src="{{ isset($item->image) ? asset('storage/' . $item->image) : 'https://via.placeholder.com/300' }}"
                                                alt="Item" class="w-12 h-12 rounded" />
                                            <div class="ml-3">
                                                <p class="font-medium">{{ $item->product_name }}</p>
                                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <p class="text-sm font-medium">
                                            Rp{{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                @empty
                                    <p class="text-gray-500 p-4">Keranjang kosong.</p>
                                @endforelse
                            </div>

                            <!-- Total Harga -->
                            @if ($totalPrice > 0)
                                <div class="p-4 flex justify-between items-center bg-gray-100">
                                    <p class="font-bold text-lg">Total Harga</p>
                                    <p class="font-bold text-lg">Rp{{ number_format($totalPrice, 0, ',', '.') }}</p>
                                </div>

                                <!-- Checkout Button -->
                                <form action="{{ route('order') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="carts_id" value="{{ $item->carts_id }}">
                                    <button type="submit"
                                        class="block text-center w-full bg-yellow-400 text-black font-semibold py-2 rounded hover:bg-yellow-500 transition">
                                        Lanjutkan Untuk Pembayaran
                                    </button>
                                </form>
                            @endif
                        </div>
                    </x-slot>
                </x-dropdown>

                <!-- Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-transparent hover:text-gray-500 focus:outline-none transition ease-in-out duration-150">
                            <div class="ms-1 mr-2 size-6">
                                <img src="{{ asset('img/icon-profile.png') }}" alt="Profile" />
                            </div>
                            <div>{{ Auth::user()->name }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                {{ __('user.dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

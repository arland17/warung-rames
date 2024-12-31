<x-user-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-5">Pembayaran</h1>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Rincian Pembayaran -->
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Rincian Pembayaran</h2>
                <form action="{{ route('order.process') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="payment_method" class="block text-gray-700 font-medium mb-2">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50">
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer</option>
                            <option value="e-Wallet">e-Wallet</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="mt-4 w-full bg-yellow-500 text-white py-2 rounded-lg font-semibold hover:bg-yellow-600">
                        Bayar Sekarang
                    </button>
                </form>

            </div>

            <!-- Kolom Pesanan -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Pesanan</h2>
                <ul class="space-y-4">
                    @foreach ($cartItems as $item)
                        <li class="flex items-center">
                            <img src="{{ isset($item->image) ? asset('storage/' . $item->image) : 'https://via.placeholder.com/50' }}"
                                alt="{{ $item->product_name }}" class="w-16 h-16 rounded-md">
                            <div class="ml-4 flex-1">
                                <p class="font-medium text-gray-700">{{ $item->product_name }}</p>
                                <p class="text-gray-500">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
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
                                <span class="text-gray-700">{{ $item->quantity }}</span>
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
                            </div>
                        </li>
                    @endforeach
                </ul>

                <!-- Harga Total -->
                <div class="border-t mt-6 pt-4 space-y-2">
                    <div class="flex justify-between">
                        <span>Harga Barang</span>
                        <span>Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Pengiriman</span>
                        <span>Rp. 10.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Pajak</span>
                        <span>Rp. 10.000</span>
                    </div>
                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>Rp. {{ number_format($totalPrice + 20000, 0, ',', '.') }}</span>
                        <!-- Example total including shipping & tax -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>

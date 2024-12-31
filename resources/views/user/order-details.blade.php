<x-user-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-5 text-center">Detail Pesanan</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Pesanan Anda</h2>
            <ul class="space-y-6">
                @foreach ($orderDetails as $item)
                    <li class="flex flex-wrap md:flex-nowrap items-center border-b pb-4">
                        <img src="{{ isset($item->image) ? asset('storage/' . $item->image) : 'https://via.placeholder.com/50' }}"
                            alt="{{ $item->product_name }}" class="w-16 h-16 rounded-md object-cover">
                        <div class="ml-4 flex-1">
                            <p class="font-medium text-gray-700 text-lg">{{ $item->product_name }}</p>
                            <p class="text-gray-500 text-sm">Rp. {{ number_format($item->price, 0, ',', '.') }} x
                                {{ $item->quantity }}</p>
                            <p class="text-sm text-gray-600">Metode Pembayaran: {{ $item->payment_method }}</p>
                        </div>
                        <div class="mt-4 md:mt-0 text-right">
                            <p class="font-semibold text-gray-900">Rp.
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            <form action="{{ route('order.delete', $item->orderdetails_id) }}" method="POST"
                                class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="border-t mt-6 pt-4">
                <div class="flex justify-between font-semibold text-lg">
                    <span>Total Harga</span>
                    <span>Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>

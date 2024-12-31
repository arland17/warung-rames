<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showOrderDetails()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil semua item di keranjang untuk pengguna saat ini
        $cartItems = Cart::where('users_id', $userId)->get();

        // Hitung total harga
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Kirim data ke view
        return view('user.order', compact('cartItems', 'totalPrice'));
    }

    // public function showOrderConfirmation()
    // {
    //     // Ambil ID pengguna yang sedang login
    //     $userId = Auth::id();

    //     // Ambil semua item di keranjang untuk pengguna saat ini
    //     $cartItems = Cart::where('users_id', $userId)->get();

    //     // Hitung total harga
    //     $totalPrice = $cartItems->sum(function ($item) {
    //         return $item->price * $item->quantity;
    //     });

    //     // Kirim data ke view
    //     return view('user.order-details', compact('cartItems', 'totalPrice'));
    // }

    public function processOrder(Request $request)
    {
        $userId = Auth::id();

        // Validasi input
        $request->validate([
            'payment_method' => 'required|in:Tunai,Transfer,e-Wallet',
        ]);

        // Ambil metode pembayaran
        $paymentMethod = $request->input('payment_method');

        // Ambil semua item di keranjang pengguna
        $cartItems = Cart::where('users_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        // Pindahkan data dari Cart ke OrderDetail
        foreach ($cartItems as $item) {
            OrderDetail::create([
                'users_id' => $userId,
                'product_name' => $item->product_name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'image' => $item->image,
                'payment_method' => $paymentMethod,
            ]);
        }

        // Hapus semua item di Cart untuk pengguna saat ini
        Cart::where('users_id', $userId)->delete();

        // Redirect ke halaman detail pesanan
        return redirect()->route('order.details')->with('success', 'Pesanan Anda berhasil diproses dengan metode pembayaran: ' . $paymentMethod);
    }

    public function orderDetails()
    {
        $userId = Auth::id();

        // Ambil semua item di order_details untuk pengguna saat ini
        $orderDetails = OrderDetail::where('users_id', $userId)->get();

        // Hitung total harga
        $totalPrice = $orderDetails->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Kirim data ke view
        return view('user.order-details', compact('orderDetails', 'totalPrice'));
    }

    public function deleteOrder($orderdetails_id)
    {
        $userId = Auth::id();

        // Cari pesanan berdasarkan ID dan pengguna saat ini
        $order = OrderDetail::where('orderdetails_id', $orderdetails_id)
            ->where('users_id', $userId)
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        // Hapus pesanan
        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }




    
}

<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    public function addToCart($stocks_id)
    {
        // Cari produk berdasarkan ID stok
        $stock = Stock::where('stocks_id', $stocks_id)->firstOrFail();

        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Cart::where('users_id', $userId)
                        ->where('product_name', $stock->product_name)
                        ->first();

        if ($cartItem) {
            // Jika produk sudah ada di keranjang, tambahkan kuantitas
            $cartItem->quantity++;
            $cartItem->total_price = $cartItem->calculateTotalPrice(); // Hitung total price
            $cartItem->save();
        } else {
            // Jika produk belum ada, tambahkan produk baru ke keranjang
            Cart::create([
                'users_id' => $userId,
                'product_name' => $stock->product_name,
                'price' => $stock->price,
                'quantity' => 1,
                'image' => $stock->image,
                'total_price' => $stock->price * 1, 
            ]);
        }

        return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang!');
    }

    public function viewCart()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil semua item keranjang untuk pengguna saat ini
        $cartItems = Cart::where('users_id', $userId)->get();

        // Hitung total harga
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Kirim data ke view
        return view('layouts.navigationuser', compact('cartItems', 'totalPrice'));
    }

    public function showCount()
    {
        // Get the count of items in the user's cart
        $userId = Auth::id();
        $cartItemCount = Cart::where('users_id', $userId)->count(); // Count of items in the cart

        return view('layouts.navigationuser', compact('cartItemCount'));
    }

    public function decreaseQuantity($carts_id)
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Cari item keranjang berdasarkan ID pengguna dan ID keranjang
        $cartItem = Cart::where('users_id', $userId)
                        ->where('carts_id', $carts_id)
                        ->first();

        if ($cartItem) {
            // Jika kuantitas lebih dari 1, kurangi 1
            if ($cartItem->quantity > 1) {
                $cartItem->quantity--;
                $cartItem->total_price = $cartItem->quantity * $cartItem->price; // Update total price
                $cartItem->save();
            } else {
                // Jika kuantitas 1, hapus item dari keranjang
                $cartItem->delete();
            }
        }

        return redirect()->back()->with('success', 'Item kuantitas berhasil dikurangi!');
    }

    public function increaseQuantity($carts_id)
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Cari item keranjang berdasarkan ID pengguna dan ID keranjang
        $cartItem = Cart::where('users_id', $userId)
                        ->where('carts_id', $carts_id)
                        ->first();

        if ($cartItem) {
            // Tambah kuantitas 1
            $cartItem->quantity++;
            $cartItem->total_price = $cartItem->quantity * $cartItem->price; // Update total price
            $cartItem->save();
        }

        return redirect()->back()->with('success', 'Item kuantitas berhasil ditambahkan!');
    }
}

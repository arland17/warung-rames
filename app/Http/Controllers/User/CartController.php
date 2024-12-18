<?php

namespace App\Http\Controllers\User;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    // Method untuk menambahkan produk ke keranjang
    public function addToCart( $id)
    {
        // Cari produk berdasarkan ID
        $stock = Stock::findOrFail($id);

        // Ambil keranjang yang ada dari session  
        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambahkan kuantitasnya
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Jika produk belum ada di keranjang, tambahkan produk baru
            $cart[$id] = [
                'product_name' => $stock->product_name,
                'price' => $stock->price,
                'quantity' => 1,
                'image' => $stock->image,
            ];
        }

        // Simpan keranjang ke session
        session()->put('cart', $cart);

         return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function increaseQuantity($id)
    {
        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Tambahkan kuantitas jika produk ada
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }

        // Simpan kembali keranjang ke session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Quantity increased!');
    }

    public function decreaseQuantity($id)
    {
        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Kurangi kuantitas jika produk ada dan lebih dari 1
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                // Hapus item jika kuantitas menjadi 0
                unset($cart[$id]);
            }
        }

        // Simpan kembali keranjang ke session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Quantity decreased!');
    }
}


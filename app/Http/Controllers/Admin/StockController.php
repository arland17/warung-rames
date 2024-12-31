<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{
    // Method untuk menampilkan halaman daftar produk
    public function index()
    {
        $stocks = Stock::paginate(5);
    
        return view('admin.stock.index', compact('stocks'));
    }

    // Method untuk menampilkan halaman dashboard user
    public function dashboard()
    {
        // Mengambil data produk dengan kategori 'Bungkus'
        $stocksBungkus = Stock::where('category', 'Bungkus')->get();
        
        // Mengambil data produk dengan kategori paket
        $stocksPaket = Stock::whereIn('category_paket', ['Nasi Sayur', 'Nasi Telur', 'Nasi Lauk'])->get();
        
        // Mengirim data ke view 'user.dashboard'
        return view('user.dashboard', compact('stocksBungkus', 'stocksPaket'));
    }

    // // Method untuk menghapus produk dari keranjang
    // public function removeFromCart(Request $request, $stocks_id)
    // {
    //     // Ambil keranjang dari session
    //     $cart = session()->get('cart', []);

    //     // Hapus item dari keranjang
    //     if (isset($cart[$stocks_id])) {
    //         unset($cart[$stocks_id]);
    //     }

    //     // Simpan kembali keranjang ke session
    //     session()->put('cart', $cart);

    //     return response()->json(['message' => 'Item removed from cart']);
    // }

    // Method untuk menyimpan data produk
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|in:Paket,Bungkus',
            'description' => 'required|string|max:255',
            'category_paket' => 'nullable|string|max:225',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:15048',
        ]);

        // Menyimpan data produk
        $stock = new Stock();
        $stock->product_name = $validated['product_name'];
        $stock->category = $validated['category'];
        $stock->description = $validated['description'];
        $stock->category_paket = $validated['category_paket'];
        $stock->stock = $validated['stock'];
        $stock->price = $validated['price'];

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $stock->image = $imagePath;
        }

        // Simpan data ke dalam database
        $stock->save();

        // Redirect ke halaman stock dengan pesan sukses
        return redirect()->route('admin.stock')->with('success', 'Product added successfully!');
    }

    // Method untuk menghapus data produk
    public function destroy($stocks_id)
    {
        // Cari produk berdasarkan ID (menggunakan primary key yang baru)
        $stock = Stock::findOrFail($stocks_id);

        // Hapus gambar produk jika ada
        if ($stock->image && Storage::exists('public/' . $stock->image)) {
            Storage::delete('public/' . $stock->image);
        }

        // Hapus data produk
        $stock->delete();

        // Redirect ke halaman stock dengan pesan sukses
        return redirect()->route('admin.stock')->with('success', 'Product deleted successfully!');
    }
}

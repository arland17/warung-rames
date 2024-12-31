<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('carts_id')->primary(); 
            $table->foreignId('users_id') // Foreign key untuk menghubungkan pengguna
                  ->constrained('users', 'users_id') // Mengacu ke kolom 'user_id' di tabel 'users'
                  ->onDelete('cascade'); // Jika user dihapus, semua item keranjang akan dihapus
            $table->decimal('price', 10, 2); // Harga produk
            $table->string('product_name'); // Nama produk
            $table->string('image')->nullable(); // Gambar produk
            $table->integer('quantity')->default(1); // Kuantitas produk di keranjang
            $table->decimal('total_price', 10, 2)->nullable(false); // Total harga untuk kuantitas produk
            $table->string('ManagedByAdminID')->nullable();
            $table->enum('payment_method', ['Tunai', 'Transfer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

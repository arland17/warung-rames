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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('orderdetails_id');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->string('payment_method');
            $table->timestamps();
            $table->foreignId('users_id') // Foreign key untuk menghubungkan pengguna
                  ->constrained('users', 'users_id') // Mengacu ke kolom 'user_id' di tabel 'users'
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

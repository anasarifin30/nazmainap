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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('homestay_id')
                  ->constrained('homestays')
                  ->onDelete('cascade');
            $table->date('check_in');
            $table->date('check_out');
            $table->decimal('base_price', 10, 2);    // total harga kamar
            $table->decimal('service_price', 10, 2);  // nilai layanan
            $table->decimal('total_price', 10, 2);    // total bayar
            $table->enum('status', ['cart', 'belum dibayar', 'menunggu', 'aktif', 'dibatalkan', 'selesai'])
                  ->default('cart');
            $table->timestamps();
            $table->timestamp('payment_deadline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

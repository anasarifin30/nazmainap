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
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')
                  ->constrained('bookings')
                  ->onDelete('cascade');
            $table->foreignId('room_id')
                  ->constrained('rooms')
                  ->onDelete('cascade');
            $table->unsignedInteger('quantity');      // jumlah kamar yang dibooking
            $table->date('check_in');                // tanggal check-in
            $table->date('check_out');               // tanggal check-out
            $table->decimal('price_per_night', 10, 2); // harga per malam per kamar
            $table->decimal('subtotal_price', 10, 2);  // harga kamar x quantity x durasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};

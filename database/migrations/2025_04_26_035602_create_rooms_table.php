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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            // Relasi ke homestays
            $table->foreignId('homestay_id')
                  ->constrained('homestays')
                  ->onDelete('cascade');
    
            $table->string('name');            // Nama kamar (misal: "Deluxe Room")
            $table->text('description')->nullable();  // Deskripsi kamar
            $table->decimal('price', 10, 2);   // Harga per malam
            $table->unsignedInteger('max_guests')->default(1);  // Kapasitas tamu
            $table->unsignedInteger('total_rooms')->default(1); // Jumlah unit kamar
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

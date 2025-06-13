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
        Schema::create('homestay_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('homestay_id')
                  ->constrained('homestays')
                  ->onDelete('cascade');
            $table->foreignId('facility_id')
                  ->constrained('facilities')
                  ->onDelete('cascade');
            $table->timestamps();
            
            // Prevent duplicate facilities for same homestay
            $table->unique(['homestay_id', 'facility_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homestay_facilities');
    }
};
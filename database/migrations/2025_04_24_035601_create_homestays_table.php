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
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('kodebumdes')->nullable();
            $table->string('name');
            $table->text('description');
            $table->string('address')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();   
            $table->string('kecamatan')->nullable();
            $table->enum('status', ['menunggu', 'terverifikasi', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homestays');
    }
};

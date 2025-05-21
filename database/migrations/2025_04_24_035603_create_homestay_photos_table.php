<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomestayPhotosTable extends Migration
{
    public function up()
    {
        
        Schema::create('homestay_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('homestay_id');
            $table->unsignedBigInteger('category_id'); 
            $table->string('photo_path');
            $table->boolean('is_cover')->default(false);
            $table->timestamps();

            $table->foreign('homestay_id')->references('id')->on('homestays')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('photo_categories')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('homestay_photos');
    }
}

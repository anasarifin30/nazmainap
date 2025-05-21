<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('photo_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('photo_categories');
    }
}

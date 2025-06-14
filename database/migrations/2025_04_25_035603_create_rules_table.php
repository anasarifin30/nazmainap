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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('homestay_id')
                  ->constrained('homestays')
                  ->onDelete('cascade');
            $table->foreignId('rule_template_id')
                  ->constrained('rule_templates')
                  ->onDelete('cascade');
            $table->text('custom_rule_text')->nullable(); // Jika owner ingin custom text
            $table->timestamps();
            
            // Prevent duplicate rules for same homestay
            $table->unique(['homestay_id', 'rule_template_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};

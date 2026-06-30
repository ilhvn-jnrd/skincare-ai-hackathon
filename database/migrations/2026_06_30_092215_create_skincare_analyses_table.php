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
        Schema::create('skincare_analyses', function (Blueprint $table) {
            $table->id();
            $table->text('product_names')->comment('Contoh input: Pembersih CeraVe, Sunscreen Azarine, Salicylic Acid, Vitamin K');
            $table->longText('ai_response')->nullable()->comment('Menyimpan hasil analisis teks dari Vertex AI');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skincare_analyses');
    }
};

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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('category');           // e.g. 'Beach & Island', 'City Tour'
            $table->string('title');              // e.g. 'Bali Paradise Escape'
            $table->unsignedBigInteger('price'); // Price in IDR (Rupiah)
            $table->decimal('rating', 3, 1);     // e.g. 4.8
            $table->unsignedInteger('reviews');  // Number of reviews
            $table->text('image');               // Image URL or path
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes
            $table->index('category');
            $table->index('price');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};

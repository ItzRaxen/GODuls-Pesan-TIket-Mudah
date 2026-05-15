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
            $table->string('booking_id', 20)->unique();      // e.g. 'GDL-A1B2C3D4'
            $table->foreignId('destination_id')
                  ->constrained('destinations')
                  ->cascadeOnDelete();
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->date('travel_date');
            $table->unsignedTinyInteger('guests')->default(1);
            $table->unsignedBigInteger('total_price');       // price * guests
            $table->unsignedBigInteger('tax_amount');        // 10% tax
            $table->unsignedBigInteger('grand_total');       // total + tax
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])
                  ->default('confirmed');
            $table->timestamps();

            // Indexes
            $table->index('booking_id');
            $table->index('status');
            $table->index('travel_date');
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

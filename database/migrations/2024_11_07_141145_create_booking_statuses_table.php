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
        Schema::create('booking_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->enum('status_name', [
                'Available',
                'Booked',
                'Reserved',
                'Sold',
                'Pending',     // Status when under review or waiting for confirmation
                'Cancelled',   // Status if booking is cancelled
                'Under Offer'  // Status if a buyer's offer is being considered
            ])->default('Available'); // Sets a default status if not specified
            $table->string('color_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_statuses');
    }
};

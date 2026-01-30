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
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_lot_id');
            $table->string('spot_number');
            $table->enum('status', ['available', 'occupied', 'reserved', 'broken','inactive'])->default('available');
            $table->string('deactivated_reason')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parking_lot_id')->references('id')->on('parking_lots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_spots');
    }
};

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
        Schema::create('parking_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_spot_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('booked_by')->nullable(); // admin yang membuat booking untuk user
            $table->enum('type', ['booking', 'walk_in'])->default('walk_in');
            $table->timestamp('booked_at')->useCurrent(); // waktu booking dibuat
            $table->timestamp('start_at')->nullable(); // waktu booking dimulai
            $table->timestamp('expired_at')->nullable(); // waktu booking berakhir
            $table->timestamp('checkin_at')->nullable(); // waktu user check-in/parkir
            $table->timestamp('checkout_at')->nullable(); // waktu user check-out
            $table->enum('status', ['booked', 'active', 'expired', 'completed', 'cancelled'])->default('booked');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parking_spot_id')->references('id')->on('parking_spots')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('booked_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_books');
    }
};

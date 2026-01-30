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
        Schema::create('parking_book_cancellations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_book_id');
            $table->enum('cancellation_type', ['user_cancelled', 'admin_cancelled', 'system_cancelled']);
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->string('reason');
            $table->timestamp('cancelled_at')->useCurrent();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parking_book_id')->references('id')->on('parking_books')->onDelete('cascade');
            $table->foreign('cancelled_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_book_cancellations');
    }
};

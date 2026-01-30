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
        Schema::create('parking_book_relocations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_book_id');
            $table->unsignedBigInteger('from_parking_spot_id');
            $table->unsignedBigInteger('to_parking_spot_id');
            $table->unsignedBigInteger('relocated_by');
            $table->string('relocate_reason');
            $table->timestamp('relocated_at')->useCurrent();
            $table->enum('status', ['active', 'reverted'])->default('active');
            $table->unsignedBigInteger('reverted_by')->nullable();
            $table->string('revert_reason')->nullable();
            $table->timestamp('reverted_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parking_book_id')->references('id')->on('parking_books')->onDelete('cascade');
            $table->foreign('from_parking_spot_id')->references('id')->on('parking_spots')->onDelete('cascade');
            $table->foreign('to_parking_spot_id')->references('id')->on('parking_spots')->onDelete('cascade');
            $table->foreign('relocated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reverted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_book_relocations');
    }
};

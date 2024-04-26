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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phone_id')->constrained()->onDelete('cascade');
            $table->text('comment');
            $table->enum('rating', ['spam', 'scam', 'uncertain', 'positive']);
            $table->string('ip_address')->nullable();
            $table->string('region')->nullable()->default('VN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

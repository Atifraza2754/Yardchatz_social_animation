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
        Schema::create('video_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign Key for User
            $table->unsignedBigInteger('video_id'); // Foreign Key for Video
            $table->boolean('like')->default(false); // false for unliked, true for liked
            $table->timestamps(); // Created_at and updated_at
    
            // Add Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_likes');
    }
};

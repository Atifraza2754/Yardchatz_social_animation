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
        Schema::create('video_comments', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key to the users table
            $table->foreignId('video_id')->constrained()->onDelete('cascade');  // Foreign key to the videos table
            $table->text('comment');  // Comment text
            $table->timestamps();  // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_comments');
    }
};

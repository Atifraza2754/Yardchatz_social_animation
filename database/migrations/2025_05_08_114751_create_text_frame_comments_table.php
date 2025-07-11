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
        Schema::create('text_frame_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('text_id')->constrained('text_in_frame')->onDelete('cascade');  // Foreign key to `stills` table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');   // Foreign key to `users` table
            $table->text('comment');  // The comment text
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_frame_comments');
    }
};

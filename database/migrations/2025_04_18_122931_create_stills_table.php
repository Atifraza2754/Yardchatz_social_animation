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
        Schema::create('stills', function (Blueprint $table) {
            $table->id();
            $table->string('image_path'); // Column for storing the image path
            $table->string('frame_path'); // Column for storing the audio path
            $table->unsignedBigInteger('user_id'); // Foreign key column for users table
            $table->timestamps(); 

            // Set the user_id as a foreign key referencing the 'users' table's 'id' column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stills');
    }
};

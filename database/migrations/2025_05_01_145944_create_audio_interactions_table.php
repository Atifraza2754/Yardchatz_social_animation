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
        Schema::create('audio_interactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('audio_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('like')->default(0);
            $table->integer('comment')->default(0);
            $table->timestamps();

            $table->foreign('audio_id')->references('id')->on('audios')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio_interactions');
    }
};

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
        Schema::create('video_call_recordings', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('caller_id');
        $table->unsignedBigInteger('receiver_id');
        $table->string('file_path');
        $table->integer('duration')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_call_recordings');
    }
};

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
        Schema::create('call_logs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('caller_id');
        $table->unsignedBigInteger('receiver_id');
        $table->enum('call_type', ['audio', 'video']); 
        $table->string('status')->default('missed'); 
        $table->integer('duration')->nullable(); 
        $table->timestamp('started_at')->nullable();
        $table->timestamp('ended_at')->nullable();
        $table->timestamps();

        $table->foreign('caller_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_logs');
    }
};

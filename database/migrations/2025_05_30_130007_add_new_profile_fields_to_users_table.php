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
        Schema::table('users', function (Blueprint $table) {
            $table->string('workplace')->nullable();
            $table->string('school')->nullable();
            $table->string('Pensacola')->nullable();
            $table->date('dob')->nullable();
            $table->string('loves')->nullable();
            $table->string('home_town')->nullable();
            $table->string('current_city')->nullable();
            $table->string('favorite_song')->nullable();
            $table->string('employer')->nullable();
            $table->string('job_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::table('users', function (Blueprint $table) {
        $table->enum('privacy_setting', ['friends', 'nobody', 'everyone'])->default('everyone');
    });
}

public function down(): void {
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('privacy_setting');
    });
}

};

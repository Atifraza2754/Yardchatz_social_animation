<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToStillsTable extends Migration
{
    public function up()
    {
        Schema::table('stills', function (Blueprint $table) {
            $table->text('description')->nullable()->after('frame_path'); // or after any column you prefer
        });
    }

    public function down()
    {
        Schema::table('stills', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}

?>
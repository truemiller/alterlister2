<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEventReferrer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('events'))
            Schema::table('events', function (Blueprint $table) {
                //
                $table->string('referer')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('events'))
            Schema::table('events', function (Blueprint $table) {
                //
                $table->dropColumn('referer');
            });
    }
}

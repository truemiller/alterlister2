<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntitiesAddPublisher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::disableForeignKeyConstraints();
            Schema::table('entities', function($table){
                $table->unsignedBigInteger('publisher_id')->nullable();
            });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::disableForeignKeyConstraints();
            Schema::table('entities', function($table){
                $table->dropColumn('publisher_slug');
                $table->dropForeignKey('publisher_slug');
            });
        Schema::enableForeignKeyConstraints();
    }
}

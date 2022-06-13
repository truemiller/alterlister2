<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEventsEntityRelationToSlugNotId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->string('entity_slug')->nullable();
            $table->foreign('entity_slug')->references('slug')->on('entities')->onDelete('cascade');
            $table->dropColumn('entity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('events')){
            Schema::drop('events');
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntityPlatformPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('entity_platform'))
            Schema::create('entity_platform', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('entity_id')->unsigned()->index();
                $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
                $table->bigInteger('platform_id')->unsigned()->index();
                $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
                $table->primary(['entity_id', 'platform_id']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_platform');
    }
}

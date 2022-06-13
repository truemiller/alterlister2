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
                $table->bigInteger('entity_id')->unsigned();
                $table->bigInteger('platform_id')->unsigned();
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

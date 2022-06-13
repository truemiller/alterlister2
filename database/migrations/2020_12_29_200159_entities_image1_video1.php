<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntitiesImage1Video1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::table('entities', function (Blueprint $table) {
                $table->text('image_1')->nullable();
                $table->text('video_1')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::table('entities', function (Blueprint $table) {
            //
            $table->dropColumn(['image_1', 'video_1']);
        });
    }
}

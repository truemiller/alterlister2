<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntityExplicitAlternatives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add string alternatives column for explicit alternative definition
        if(!Schema::hasColumn('entities', 'alternatives'))
            Schema::table('entities', function ($table){
                $table->text('alternatives')->nullable();
            });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // remove string alternatives column for explicit alternative definition
        if(Schema::hasColumn('entities', 'alternatives'))
            Schema::table('entities', function ($table){
                $table->dropColumn('alternatives');
            });

    }
}

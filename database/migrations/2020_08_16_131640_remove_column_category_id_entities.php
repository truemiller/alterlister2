<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnCategoryIdEntities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();

        Schema::table('entities', function (Blueprint $table) {
            $table->dropForeign('entities_category_id_foreign');
            $table->dropColumn('category_id');
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
        Schema::disableForeignKeyConstraints();
        Schema::table('entities', function (Blueprint $table) {
            //
            if(!Schema::hasColumn($table->getTable(),'category_id'))
                $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table->unsignedBigInteger('category_id');
        });
        Schema::enableForeignKeyConstraints();
    }
}

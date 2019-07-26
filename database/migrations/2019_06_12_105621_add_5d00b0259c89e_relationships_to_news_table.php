<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d00b0259c89eRelationshipsToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function(Blueprint $table) {
            if (!Schema::hasColumn('news', 'tags_id')) {
                $table->integer('tags_id')->unsigned()->nullable();
                $table->foreign('tags_id', '313750_5d00b01ecb771')->references('id')->on('tags')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function(Blueprint $table) {
            
        });
    }
}

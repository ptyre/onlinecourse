<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1560326488TitlefootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('titlefooters')) {
            Schema::create('titlefooters', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->string('qoute')->nullable();
                $table->text('small_descriptive_footer')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titlefooters');
    }
}

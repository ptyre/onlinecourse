<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1560325126CommentstudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('commentstudents')) {
            Schema::create('commentstudents', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->text('deskripsi')->nullable();
                $table->string('photo_comment')->nullable();
                $table->string('job')->nullable();
                $table->tinyInteger('show')->nullable()->default('0');
                
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
        Schema::dropIfExists('commentstudents');
    }
}

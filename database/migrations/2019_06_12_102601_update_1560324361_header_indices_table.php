<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1560324361HeaderIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('header_indices', function (Blueprint $table) {
            
if (!Schema::hasColumn('header_indices', 'show')) {
                $table->tinyInteger('show')->nullable()->default('0');
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
        Schema::table('header_indices', function (Blueprint $table) {
            $table->dropColumn('show');
            
        });

    }
}

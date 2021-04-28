<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvailableGardenIdToFilledCells extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filled_cells', function (Blueprint $table) {
            $table->foreignId('available_garden_id')->after('id')->default(1)->constrained('available_gardens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filled_cells', function (Blueprint $table) {
            //
        });
    }
}

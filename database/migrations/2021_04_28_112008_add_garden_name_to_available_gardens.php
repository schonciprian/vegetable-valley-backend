<?php

use App\Http\Traits\ChangeColumnType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGardenNameToAvailableGardens extends Migration
{
    use ChangeColumnType;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('available_gardens', function (Blueprint $table) {
            $this->changeColumnType('available_gardens', 'user_id', 'bigint');

            $table->foreign('user_id')->references('id')->on('users');

            $table->string('garden_name')->after('user_id')->default('New garden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('available_gardens', function (Blueprint $table) {
            //
        });
    }
}

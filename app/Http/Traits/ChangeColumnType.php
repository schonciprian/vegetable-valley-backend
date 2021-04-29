<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait ChangeColumnType {
    public function changeColumnType($table, $column, $newColumnType) {
        DB::statement("ALTER TABLE $table ALTER COLUMN $column TYPE $newColumnType");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilledCells extends Model
{
    use HasFactory;

    protected $table = 'filled_cells';

    protected $fillable = [
        'user_id',
        'available_garden_id',
        'cell_row',
        'cell_column',
        'cell_name',
        'cell_picture_url',
    ];
}

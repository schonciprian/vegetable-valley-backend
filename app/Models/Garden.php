<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cell_row',
        'cell_column',
        'cell_name',
        'cell_picture_url',
    ];
}

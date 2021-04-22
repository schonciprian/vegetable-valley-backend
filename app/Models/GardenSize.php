<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GardenSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'row_count',
        'column_count',
    ];
}

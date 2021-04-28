<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GardenSize extends Model
{
    use HasFactory;

    protected $table = 'available_gardens';

    protected $fillable = [
        'user_id',
        'garden_name',
        'row_count',
        'column_count',
    ];
}

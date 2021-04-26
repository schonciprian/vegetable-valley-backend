<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableGardens extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'garden_name',
    ];

    public function users(){
        return $this->belongsTo('users', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageTags extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tag_name',
        'tag_color',
    ];
}

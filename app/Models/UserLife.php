<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLife extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'life_points',
    ];
}

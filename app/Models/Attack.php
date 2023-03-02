<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attack extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_attack_id',
        'user_affected_id',
        'type_attack_id',
    ];
}

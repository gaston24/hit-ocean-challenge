<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemEquipped extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'type_item',
    ];
}

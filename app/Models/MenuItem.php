<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
 protected $fillable = [
    'item_code',
    'name',
    'category',
    'description',
    'price',
    'is_active',
];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'item_id',
        'item_name',
        'item_id',
    ];

    public function item_name()
    {
        return $this->hasMany('App\Models\ItemLog','item_id');
    }
}

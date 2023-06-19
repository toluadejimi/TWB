<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLog extends Model
{
    protected $fillable = [
        'data',
        'price',
        'item_id',
        'area_code',
    ];


    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}

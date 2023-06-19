<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'user_id',
        'trx_ref',
        'amount',
        'created_at',
        'updated_at',
        'type',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


}

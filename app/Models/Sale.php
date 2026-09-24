<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // ★一括割り当てを許可するカラムを指定
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];
}
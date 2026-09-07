<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 一括代入を許可するカラムを指定
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
    ];

    /**
     * ユーザーとのリレーション（商品は1人のユーザーに属する）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
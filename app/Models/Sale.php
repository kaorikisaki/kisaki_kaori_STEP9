<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * 一括割り当てを許可するカラムを指定
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * 購入した商品情報を取得（多対一のリレーション）
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * 購入したユーザー情報を取得（必要に応じて）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
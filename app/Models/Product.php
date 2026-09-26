<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id', 
        'product_name',
        'description',
        'price',
        'img_path',
        'stock',
    ];

    /**
     * 出品したユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 属している会社を取得（★追加）
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * いいね一覧を取得
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * 購入履歴一覧を取得
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
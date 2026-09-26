<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
    ];

    /**
     * 会社に属する商品を取得
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
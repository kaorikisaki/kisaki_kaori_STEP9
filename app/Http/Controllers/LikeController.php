<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Product $product)
    {
        Auth::user()->likes()->firstOrCreate([
            'product_id' => $product->id,
        ]);

        return back();
    }

    public function destroy(Product $product)
    {
        Auth::user()->likes()->where('product_id', $product->id)->delete();

        return back();
    }
}
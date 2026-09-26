<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. テストユーザーの作成
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 2. 会社データの作成
        $company = Company::create([
            'company_name' => 'TNG',
        ]);

        // 3. 商品データの作成（img_pathを追加）
        Product::create([
            'product_name' => 'タブレット',
            'description' => 'これは最新のタブレットです。',
            'price' => 100,
            'stock' => 3,
            'company_id' => $company->id,
            'user_id' => $user->id,
            'img_path' => 'dummy.jpg', 
        ]);
    }
}
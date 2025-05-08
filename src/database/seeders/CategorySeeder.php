<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first(); // 最初のユーザーを取得

        $categories = ['資料請求', 'ご相談', 'その他'];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'user_id' => $user->id,
            ]);
        }
    }
}
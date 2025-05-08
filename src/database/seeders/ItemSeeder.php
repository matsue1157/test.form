<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;


class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryIds = Category::pluck('id')->all();

        Item::factory()->count(35)->create([
            'category_id' => function () use ($categoryIds) {
                return $categoryIds[array_rand($categoryIds)];
            }
        ]);
    }
}

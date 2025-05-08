<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\User;
use App\Models\Category;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::pluck('id')->all();
        $categories = Category::pluck('id')->all();
        Contact::factory()->count(35)->create([
            'user_id' => function () use ($users) {
                return $users[array_rand($users)];
            },
            'category_id' => function () use ($categories) {
                return $categories[array_rand($categories)];
            },
        ]);
    }
}

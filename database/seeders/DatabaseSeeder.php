<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory([
            'name' => 'Super Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com'
        ])->create();

        Shop::factory(10)->create()->each(function($store) {

        });

        User::factory(100)->create();
    }
}

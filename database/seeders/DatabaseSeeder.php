<?php

namespace Database\Seeders;

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

        User::factory(10)->create();
    }
}

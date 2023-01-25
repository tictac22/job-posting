<?php

namespace Database\Seeders;

use App\Models\Users;
use Database\Factories\UsersFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::factory()->count(50)->create();
    }
}

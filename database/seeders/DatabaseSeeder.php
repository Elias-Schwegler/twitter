<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tweet;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        Tweet::factory(200)->create();
    }
}

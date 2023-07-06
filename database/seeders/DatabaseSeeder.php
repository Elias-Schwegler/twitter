<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
        ]);

        User::first()->update([
            'email' => 'user@example.com',
            'password' => bcrypt('password')
        ]);
    }
}

/*    
    public function run()
    {
        User::factory()
            ->count(20)
            ->has(Tweet::factory()->count(30))
            ->create();
    }*/
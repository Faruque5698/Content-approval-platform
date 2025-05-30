<?php

namespace Database\Seeders;

use App\Helpers\Classes\CacheHelper;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
//        User::factory(100)->create(); // Uncomment to create 100 users
//        Cache::flush();
    }
}

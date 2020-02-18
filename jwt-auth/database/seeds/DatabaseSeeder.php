<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        // DB::table('users')->truncate();
        $this->call(UserSeeder::class);
        $this->call(BookSeeder::class);
    }
}

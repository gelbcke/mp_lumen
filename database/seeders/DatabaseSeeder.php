<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checking because truncate() will fail
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Clear Tables
        User::truncate();
        Vehicle::truncate();

        // Create new Data
        User::factory()->count(10)->create();
        Vehicle::factory()->count(50)->create();

        // Enable it back
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

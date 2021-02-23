<?php

namespace Database\Seeders;

use App\Models\Project;
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
        //Seed 5 users first
        User::factory()->count(5)->create();
        //Then seed 10 projects
        Project::factory()->count(10)->create();
    }
}

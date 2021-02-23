<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = Carbon::now();
        $end = Carbon::now();
        $status = ['pending','ongoing','completed','cancelled'];
        return [
            'title' => $this->faker->sentence(5),
            'details' => $this->faker->paragraph(5),
            'status' =>$status[rand(0,3)],
            'start_date' =>$start->addDays(rand(1,5)),
            'end_date' =>$end->addDays(rand(55,99)),
             //Random Existing User
            'project_manager_id' => User::all()->random()->id,
            // 'project_manager_id' => User::factory();
        ];
    }
}

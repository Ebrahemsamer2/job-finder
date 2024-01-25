<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */

 use App\Models\User;
 use App\Models\Category;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $job_types = ['Full Time', 'Part Time', 'Remotly', 'Freelance'];
    protected $experience_needed = ['0 - 1', '1 - 2', '2 - 4', '3 - 6' , 'more than 6'];
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'short_description' => fake()->paragraph(),
            'job_type' => $this->job_types[rand(0, count($this->job_types) - 1)],
            'country' => 'Egypt',
            'city' => 'Alexandria',
            'open_positions' => 3,
            'experience_needed' =>  $this->experience_needed[rand(0, count($this->experience_needed) - 1)],
            'salary_range_from' => 2000,
            'salary_range_to' => 4000,
            'job_description' => fake()->paragraph() . ';' . fake()->paragraph() . ';' . fake()->paragraph(),
            'job_requirements' => fake()->sentence() . ';' . fake()->sentence() . ';' . fake()->sentence(),
            'skills' => fake()->name() . ';' . fake()->name() . ';' . fake()->name() . ';' . fake()->name() . ';' . fake()->name(),
            'user_id' => User::where('user_type', 'employer')->inRandomOrder()->get()[0]->id,
            'category_id' => Category::inRandomOrder()->get()[0]->id,
        ];
    }
}

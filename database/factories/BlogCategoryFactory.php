<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\blogCategory>
 */
use App\Models\User;

class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $categories = [
        'Design',
        'Mobile Application',
        'Content Writer',
        'Real Estate',
        'Information Technology',
        'Construction',
        'Front End',
        'Back End'
    ];

    public static $counter = 0;

    public function definition(): array
    {
        $name = $this->categories[self::$counter++];
        return [
            'name' => $name,
            'slug' => $this->generateSlug($name),
            'user_id' => User::where('user_type', 'admin')->inRandomOrder()->get()[0]->id,
        ];
    }

    private function generateSlug($name)
    {   
        return implode('-', explode(' ', strtolower($name)));;
    }
}

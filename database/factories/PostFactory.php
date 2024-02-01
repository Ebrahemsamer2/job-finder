<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */

 use App\Models\BlogCategory;
 use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $thumbnails = [
        'home-blog1.jpg',
        'home-blog2.jpg'
    ];

    public function definition(): array
    {
        $title = fake()->sentence();
        return [
            'title' => $title,
            'slug' => $this->generateSlug($title),
            'body' => fake()->text(1500),
            'thumbnail' => "assets/img/blog/" . $this->thumbnails[rand(0, 1)],
            'blog_category_id' => BlogCategory::inRandomOrder()->get()[0]->id,
            'user_id' => User::where('user_type', 'admin')->inRandomOrder()->get()[0]->id,
        ];
    }

    private function generateSlug($title)
    {   
        return implode('-', explode(' ', strtolower($title)));;
    }
}

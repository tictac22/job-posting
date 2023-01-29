<?php

namespace Database\Factories;

use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	protected $model = Posts::class;
    public function definition()
    {
        return [
            'company_name' => fake()->company(),
			'job_title' =>fake()->jobTitle(),
			'location' => fake()->city(),
			'tags' =>fake()->name(),
			'logo' =>fake()->url(),
			'description' => fake()->paragraph(),
        ];
    }
}

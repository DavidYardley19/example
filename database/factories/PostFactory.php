<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            // Would i need user_id here too?
            // ans: yes, if posts belong to users, you would typically include a user_id field to establish that relationship.
            'user_id' => User::factory(),
            // What about comments?
            // ans: No, comments are usually created separately after the post is created.
        ];
    }
}

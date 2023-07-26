<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
        $title=fake()->realText();
        return [
            'title'=>$title,
            // 'slug'=>Str::slug($title,'_'),
            'content'=>fake()->text(),
            'user_id'=>fake()->numberBetween(1,10),
            'category_id'=>fake()->numberBetween(1,6),
        ];
    }
}

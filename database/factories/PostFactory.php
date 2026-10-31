<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        "title"=> $this->faker->sentence,
        "body"=> $this->faker->paragraph(3,true),
        "author"=>$this->faker->name,
        "published"=>$this->faker->boolean,
        ];
    }
}

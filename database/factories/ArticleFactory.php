<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'short_description' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraphs(5, true),
            'image' => $this->faker->imageUrl(640, 480, 'news', true),
            'views' => $this->faker->numberBetween(0, 10000),
            'is_published' => $this->faker->boolean(90),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}

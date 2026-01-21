<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\Reporter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $headline = $this->faker->sentence(6);

        return [
            'category_id' => Category::factory(),
            'reporter_id' => Reporter::factory(),
            'headline' => $headline,
            'slug' => Str::slug($headline),
            'excerpt' => $this->faker->paragraph(),
            'body' => $this->faker->paragraphs(5, true),
            'status' => 'draft',
            'published_at' => null,
            'scheduled_for' => null,
            'is_featured' => false,
            'is_breaking' => false,
        ];
    }
}

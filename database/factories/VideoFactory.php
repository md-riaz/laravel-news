<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Video>
 */
class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(5);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(),
            'embed_url' => $this->faker->url(),
            'status' => 'draft',
            'published_at' => null,
        ];
    }
}

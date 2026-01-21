<?php

namespace Database\Factories;

use App\Models\Reporter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Reporter>
 */
class ReporterFactory extends Factory
{
    protected $model = Reporter::class;

    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            'user_id' => User::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'bio' => $this->faker->paragraph(),
            'avatar_url' => $this->faker->imageUrl(200, 200, 'people', true),
        ];
    }
}

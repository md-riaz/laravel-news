<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Reporter;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Suppress model events so default seed data doesn't trigger observers during setup.
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Category::factory(5)->create();
        Tag::factory(8)->create();

        Reporter::factory(3)->create();
        Page::factory(4)->create();
        Gallery::factory(2)->create();
        Video::factory(3)->create();

        Article::factory(6)->create()->each(function (Article $article): void {
            $article->tags()->attach(Tag::inRandomOrder()->limit(2)->pluck('id'));
        });
    }
}

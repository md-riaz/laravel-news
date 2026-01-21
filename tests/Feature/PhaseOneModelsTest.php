<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Reporter;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhaseOneModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_slugs_auto_generate_for_core_models(): void
    {
        $category = Category::create(['name' => 'Breaking News']);
        $tag = Tag::create(['name' => 'Laravel']);
        $reporter = Reporter::create(['name' => 'Jane Doe']);
        $page = Page::create(['title' => 'About Us']);
        $gallery = Gallery::create(['title' => 'Photo Highlights']);
        $video = Video::create([
            'title' => 'Weekly Wrap',
            'embed_url' => 'https://example.com/video',
        ]);

        $article = Article::create([
            'category_id' => $category->id,
            'reporter_id' => $reporter->id,
            'headline' => 'Major Update',
        ]);

        $this->assertSame('breaking-news', $category->slug);
        $this->assertSame('laravel', $tag->slug);
        $this->assertSame('jane-doe', $reporter->slug);
        $this->assertSame('about-us', $page->slug);
        $this->assertSame('photo-highlights', $gallery->slug);
        $this->assertSame('weekly-wrap', $video->slug);
        $this->assertSame('major-update', $article->slug);
    }

    public function test_article_relationships_and_media_collections(): void
    {
        $article = Article::factory()->create();
        $tag = Tag::factory()->create();

        $article->tags()->attach($tag);

        $this->assertTrue($article->category()->exists());
        $this->assertTrue($article->reporter()->exists());
        $this->assertCount(1, $article->tags);
        $this->assertSame(
            ['images'],
            $article->getRegisteredMediaCollections()->pluck('name')->all()
        );
    }

    public function test_gallery_registers_images_collection(): void
    {
        $gallery = Gallery::factory()->create();

        $this->assertSame(
            ['images'],
            $gallery->getRegisteredMediaCollections()->pluck('name')->all()
        );
    }
}

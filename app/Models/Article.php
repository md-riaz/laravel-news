<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'category_id',
        'reporter_id',
        'headline',
        'slug',
        'excerpt',
        'body',
        'status',
        'published_at',
        'scheduled_for',
        'is_featured',
        'is_breaking',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'scheduled_for' => 'datetime',
        'is_featured' => 'boolean',
        'is_breaking' => 'boolean',
        'status' => ArticleStatus::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(Reporter::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    protected function getSlugSourceField(): string
    {
        return 'headline';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function attachImage(
        string $path,
        ?string $caption = null,
        ?string $credit = null
    ): Media {
        return $this->addMedia($path)
            ->withCustomProperties([
                'caption' => $caption,
                'credit' => $credit,
            ])
            ->toMediaCollection('images');
    }
}

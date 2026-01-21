<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gallery extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\GalleryFactory> */
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (Gallery $gallery): void {
            if (! $gallery->slug && $gallery->title) {
                $gallery->slug = Str::slug($gallery->title);
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }
}

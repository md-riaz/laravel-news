<?php

namespace App\Models;

use App\Enums\VideoStatus;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'embed_url',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => VideoStatus::class,
    ];

    protected function getSlugSourceField(): string
    {
        return 'title';
    }
}

<?php

namespace App\Models;

use App\Enums\PageStatus;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
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
        'body',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => PageStatus::class,
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', PageStatus::PUBLISHED)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function getBodyHtmlAttribute(): HtmlString
    {
        return new HtmlString($this->sanitizeBody($this->body));
    }

    protected function getSlugSourceField(): string
    {
        return 'title';
    }

    protected function sanitizeBody(?string $body): string
    {
        $allowedTags = '<p><br><strong><em><ul><ol><li><a><blockquote><code><pre><h1><h2><h3><h4><h5><h6>';
        $sanitized = strip_tags($body ?? '', $allowedTags);
        $sanitized = preg_replace('/\son\w+="[^"]*"/i', '', $sanitized);
        $sanitized = preg_replace("/\son\w+='[^']*'/i", '', $sanitized);
        $sanitized = preg_replace('/javascript:/i', '', $sanitized);

        return $sanitized ?? '';
    }
}

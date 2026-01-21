<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::saving(function ($model): void {
            $sourceField = $model->getSlugSourceField();

            if (! $model->slug && $model->{$sourceField}) {
                $model->slug = Str::slug($model->{$sourceField});
            }
        });
    }

    abstract protected function getSlugSourceField(): string;
}

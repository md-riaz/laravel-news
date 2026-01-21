<?php

namespace App\Enums;

enum ArticleStatus: string
{
    case DRAFT = 'draft';
    case SCHEDULED = 'scheduled';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public static function options(): array
    {
        return [
            self::DRAFT->value => 'Draft',
            self::SCHEDULED->value => 'Scheduled',
            self::PUBLISHED->value => 'Published',
            self::ARCHIVED->value => 'Archived',
        ];
    }
}

<?php

namespace App\Enums;

enum VideoStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';

    public static function options(): array
    {
        return [
            self::DRAFT->value => 'Draft',
            self::PUBLISHED->value => 'Published',
        ];
    }
}

<?php

namespace App\Enums\Adsense;


enum AdStatus: int
{
    case PUBLISHED = 1;
    case DRAFT = 2;
    case ARCHIVED = 3;

    public static function toArray(): array
    {
        return [
            self::PUBLISHED,
            self::DRAFT,
            self::ARCHIVED,
        ];
    }
}

<?php

namespace App\Enums\Adsense;


enum AdFormat: int
{
    case AUTO = 1;
    case RECTANGLE = 2;
    case BANNER = 3;
    case VERTICAL = 4;

    public static function toArray(): array
    {
        return [
            self::AUTO,
            self::RECTANGLE,
            self::BANNER,
            self::VERTICAL,
        ];
    }
}

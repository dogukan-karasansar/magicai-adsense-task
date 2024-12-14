<?php

namespace App\Enums\Adsense;

enum AdPosition: int
{
    case TOP = 1;
    case BOTTOM = 2;
    case LEFT_BAR = 3;
    case RIGHT_BAR = 4;
    case INLINE = 5;

    public static function toArray(): array
    {
        return [
            self::TOP,
            self::BOTTOM,
            self::LEFT_BAR,
            self::RIGHT_BAR,
            self::INLINE,
        ];
    }
}

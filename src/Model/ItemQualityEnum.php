<?php

declare(strict_types=1);

namespace App\Model;

enum ItemQualityEnum: int
{
    case LEGENDARY_QUALITY = 80;
    case MAX_QUALITY = 50;
    case MIN_QUALITY = 0;
}

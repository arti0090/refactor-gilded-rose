<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;
use App\Model\ItemQualityEnum;

final class NormalItemUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        $item->sell_in--;

        if ($item->quality > ItemQualityEnum::MIN_QUALITY->value) {
            $item->quality--;
        }

        if ($item->sell_in < 0 && $item->quality > ItemQualityEnum::MIN_QUALITY->value) {
            $item->quality--;
        }
    }
}

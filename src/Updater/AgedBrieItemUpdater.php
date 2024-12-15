<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;
use App\Model\ItemQualityEnum;

final class AgedBrieItemUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        $item->sell_in--;

        if ($item->quality < ItemQualityEnum::MAX_QUALITY->value) {
            $item->quality++;
        }

        if ($item->quality === ItemQualityEnum::MAX_QUALITY->value) {
            return;
        }

        if ($item->sell_in < ItemQualityEnum::MIN_QUALITY->value) {
            $item->quality++;
        }
    }
}

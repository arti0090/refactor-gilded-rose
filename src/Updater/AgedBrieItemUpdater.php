<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;
use App\Model\ItemQualityEnum;

final class AgedBrieItemUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        $item->setSellIn($item->getSellIn() - 1);

        $quality = $item->getQuality();

        if ($quality < ItemQualityEnum::MAX_QUALITY->value) {
            $item->setQuality(++$quality);
        }

        if ($quality === ItemQualityEnum::MAX_QUALITY->value) {
            return;
        }

        if ($item->getSellIn() < ItemQualityEnum::MIN_QUALITY->value) {
            $item->setQuality(++$quality);
        }
    }
}

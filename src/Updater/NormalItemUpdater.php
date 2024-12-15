<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;
use App\Model\ItemQualityEnum;

final class NormalItemUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        $sellIn = $item->getSellIn();
        $quality = $item->getQuality();

        $item->setSellIn(--$sellIn);

        if ($quality > ItemQualityEnum::MIN_QUALITY->value) {
            $item->setQuality(--$quality);
        }

        if ($sellIn < 0 && $quality > ItemQualityEnum::MIN_QUALITY->value) {
            $item->setQuality(--$quality);
        }
    }
}

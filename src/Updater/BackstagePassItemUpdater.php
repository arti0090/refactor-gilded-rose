<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;
use App\Model\ItemQualityEnum;

final class BackstagePassItemUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        $item->sell_in--;

        if ($item->sell_in < 0) {
            $item->quality = ItemQualityEnum::MIN_QUALITY->value;
            return;
        }

        if ($item->sell_in < 5) {
            $this->increaseQuality($item, 3);
            return;
        }

        if ($item->sell_in < 10) {
            $this->increaseQuality($item, 2);
            return;
        }

        $this->increaseQuality($item);
    }

    private function increaseQuality(Item $item, int $amount = 1): void
    {
        $item->quality = min($item->quality + $amount, ItemQualityEnum::MAX_QUALITY->value);
    }
}

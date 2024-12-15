<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;
use App\Model\ItemQualityEnum;

final class BackstagePassItemUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        $sellIn = $item->getSellIn();
        $item->setSellIn(--$sellIn);

        if ($sellIn < 0) {
            $item->setQuality(ItemQualityEnum::MIN_QUALITY->value);
            return;
        }

        if ($sellIn < 5) {
            $this->increaseQuality($item, 3);
            return;
        }

        if ($sellIn < 10) {
            $this->increaseQuality($item, 2);
            return;
        }

        $this->increaseQuality($item);
    }

    private function increaseQuality(Item $item, int $amount = 1): void
    {
        $item->setQuality(\min(
            $item->getQuality() + $amount,
            ItemQualityEnum::MAX_QUALITY->value,
        ));
    }
}

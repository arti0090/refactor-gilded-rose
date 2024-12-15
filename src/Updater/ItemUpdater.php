<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;

abstract class ItemUpdater implements ItemUpdaterInterface
{
    protected const MAX_QUALITY = 50;
    protected const MIN_QUALITY = 0;

    protected function decreaseSellIn(Item $item): void {
        $item->setSellIn($item->getSellIn() - 1);
    }

    protected function decreaseQuality(Item $item, int $amount = 1): void {
        $item->setQuality(\max(
            self::MIN_QUALITY,
            $item->getQuality() - $amount,
        ));
    }

    protected function increaseQuality(Item $item, int $amount = 1): void
    {
        $item->setQuality(\min(
            $item->getQuality() + $amount,
            self::MAX_QUALITY,
        ));
    }

    abstract public function update(Item $item): void;
}

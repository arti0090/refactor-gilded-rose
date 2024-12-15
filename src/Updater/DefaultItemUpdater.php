<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;

final class DefaultItemUpdater extends ItemUpdater
{
    public function update(Item $item): void
    {
        $this->decreaseSellIn($item);

        $sellIn = $item->getSellIn();
        $quality = $item->getQuality();

        if ($sellIn < 0 && $quality > self::MIN_QUALITY) {
            $this->decreaseQuality($item, 2);
            return;
        }

        if ($quality > self::MIN_QUALITY) {
            $this->decreaseQuality($item);
        }
    }
}

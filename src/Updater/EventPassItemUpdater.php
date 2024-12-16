<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;

final class EventPassItemUpdater extends ItemUpdater
{
    public function update(Item $item): void
    {
        $this->decreaseSellIn($item);
        $sellIn = $item->getSellIn();

        if ($sellIn < 0) {
            $item->setQuality(self::MIN_QUALITY);
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
}

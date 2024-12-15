<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;

final class AgedBrieItemUpdater extends ItemUpdater
{
    public function update(Item $item): void
    {
        $this->decreaseSellIn($item);

        $quality = $item->getQuality();

        if ($quality < self::MAX_QUALITY) {
            $this->increaseQuality($item);
        }

        if ($quality === self::MAX_QUALITY) {
            return;
        }

        if ($item->getSellIn() < self::MIN_QUALITY) {
            $this->increaseQuality($item);
        }
    }
}

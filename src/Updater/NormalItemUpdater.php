<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;

final class NormalItemUpdater extends ItemUpdater
{
    public function update(Item $item): void
    {
        $this->decreaseSellIn($item);

        $sellIn = $item->getSellIn();
        $quality = $item->getQuality();

        if ($quality > self::MIN_QUALITY) {
            $this->decreaseQuality($item);
        }

        if ($sellIn < 0 && $quality > self::MIN_QUALITY) {
            $this->decreaseQuality($item);
        }
    }
}

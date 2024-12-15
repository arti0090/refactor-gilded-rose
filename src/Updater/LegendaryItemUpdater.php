<?php

declare(strict_types=1);

namespace App\Updater;

use App\Model\Item;

// Note: even if update has just early return, creating it was imo
// 1.more consistent with rest of updaters
// 2. clearly showing nothing will update on legendary items
// 3. using it we can change requirements of updating this item without modification of GildedRose file
final class LegendaryItemUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        return;
    }
}

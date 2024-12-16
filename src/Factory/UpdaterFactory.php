<?php

declare(strict_types=1);

namespace App\Factory;

use App\Model\Item;
use App\Model\ItemType;
use App\Updater\AppreciatingItemUpdater;
use App\Updater\EventPassItemUpdater;
use App\Updater\ItemUpdater;
use App\Updater\LegendaryItemUpdater;
use App\Updater\DefaultItemUpdater;

final class UpdaterFactory
{
    public static function createNew(Item $item): ItemUpdater {
        return match ($item->getType()) {
            ItemType::APPRECIATING_ITEM_TYPE => new AppreciatingItemUpdater(),
            ItemType::EVENT_PASS_ITEM_TYPE => new EventPassItemUpdater(),
            ItemType::LEGENDARY_ITEM_TYPE => new LegendaryItemUpdater(),
            default => new DefaultItemUpdater(),
        };
    }
}

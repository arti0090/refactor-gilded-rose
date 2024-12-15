<?php

declare(strict_types=1);

namespace App\Factory;

use App\Model\Item;
use App\Updater\AgedBrieItemUpdater;
use App\Updater\BackstagePassItemUpdater;
use App\Updater\ItemUpdater;
use App\Updater\LegendaryItemUpdater;
use App\Updater\NormalItemUpdater;

final class UpdaterFactory
{
    public static function createNew(Item $item): ItemUpdater {
        return match ($item->getName()) {
            'Aged Brie' => new AgedBrieItemUpdater(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePassItemUpdater(),
            'Sulfuras, Hand of Ragnaros' => new LegendaryItemUpdater(),
            default => new NormalItemUpdater(),
        };
    }
}

<?php

declare(strict_types=1);

namespace App;

use App\Model\Item;
use App\Updater\AgedBrieItemUpdater;
use App\Updater\BackstagePassItemUpdater;
use App\Updater\LegendaryItemUpdater;
use App\Updater\NormalItemUpdater;

final class GildedRose
{
    public const AGED_BRIE_ITEM = 'Aged Brie';
    public const BACKSTAGE_ITEM = 'Backstage passes to a TAFKAL80ETC concert';
    public const SULFURAS_ITEM = 'Sulfuras, Hand of Ragnaros';

    private array $updaters;

    public function __construct()
    {
        $this->updaters = [
            self::AGED_BRIE_ITEM => new AgedBrieItemUpdater(),
            self::BACKSTAGE_ITEM => new BackstagePassItemUpdater(),
            self::SULFURAS_ITEM => new LegendaryItemUpdater(),
            'Normal Item' => new NormalItemUpdater(),
        ];
    }

    public function updateQuality(Item $item): void
    {
        $updater = $this->updaters[$item->getName()] ?? new NormalItemUpdater();
        $updater->update($item);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Updater;

use App\Model\Item;
use App\Model\ItemType;
use App\Updater\ItemUpdaterInterface;
use App\Updater\LegendaryItemUpdater;
use PHPUnit\Framework\TestCase;

final class LegendaryItemUpdaterTest extends TestCase
{
    private ItemUpdaterInterface $updater;

    protected function setUp(): void
    {
        $this->updater = new LegendaryItemUpdater();
    }

    public function testLegendaryItemAttributesRemainUnchanged(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 0, 80, ItemType::LEGENDARY_ITEM_TYPE);

        $this->updater->update($item);

        $this->assertEquals(0, $item->getSellIn());
        $this->assertEquals(80, $item->getQuality());
    }

    public function testLegendaryItemWithPositiveSellInRemainsUnchanged(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 5, 80, ItemType::LEGENDARY_ITEM_TYPE);

        $this->updater->update($item);

        $this->assertEquals(5, $item->getSellIn());
        $this->assertEquals(80, $item->getQuality());
    }

    public function testLegendaryItemWithNegativeSellInRemainsUnchanged(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', -1, 80, ItemType::LEGENDARY_ITEM_TYPE);

        $this->updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(80, $item->getQuality());
    }
}

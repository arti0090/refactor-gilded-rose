<?php

declare(strict_types=1);

namespace Tests\Updater;

use App\Model\Item;
use App\Model\ItemType;
use App\Updater\EventPassItemUpdater;
use App\Updater\ItemUpdaterInterface;
use PHPUnit\Framework\TestCase;

final class EventPassItemUpdaterTest extends TestCase
{
    private ItemUpdaterInterface $updater;

    protected function setUp(): void
    {
        $this->updater = new EventPassItemUpdater();
    }

    public function testQualityIncreasesByOneWhenSellInGreaterThanTen(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20, ItemType::EVENT_PASS_ITEM_TYPE);

        $this->updater->update($item);

        $this->assertEquals(14, $item->getSellIn());
        $this->assertEquals(21, $item->getQuality());
    }

    public function testQualityIncreasesByTwoWhenSellInBetweenSixAndTen(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20, ItemType::EVENT_PASS_ITEM_TYPE);

        $this->updater->update($item);

        $this->assertEquals(9, $item->getSellIn());
        $this->assertEquals(22, $item->getQuality());
    }

    public function testQualityIncreasesByThreeWhenSellInBetweenZeroAndFive(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20, ItemType::EVENT_PASS_ITEM_TYPE);

        $this->updater->update($item);

        $this->assertEquals(4, $item->getSellIn());
        $this->assertEquals(23, $item->getQuality());
    }

    public function testQualityDropsToZeroWhenSellInIsNegative(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20, ItemType::EVENT_PASS_ITEM_TYPE);

        $this->updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(0, $item->getQuality());
    }

    public function testQualityDoesNotExceedMaxQuality(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49, ItemType::EVENT_PASS_ITEM_TYPE);

        $this->updater->update($item);

        $this->assertEquals(4, $item->getSellIn());
        $this->assertEquals(50, $item->getQuality());
    }
}

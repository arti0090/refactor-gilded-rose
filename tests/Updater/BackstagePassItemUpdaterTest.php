<?php

declare(strict_types=1);

namespace Tests\Updater;

use App\Model\Item;
use App\Updater\BackstagePassItemUpdater;
use App\Updater\ItemUpdaterInterface;
use PHPUnit\Framework\TestCase;

final class BackstagePassItemUpdaterTest extends TestCase
{
    private ItemUpdaterInterface $updater;

    protected function setUp(): void
    {
        $this->updater = new BackstagePassItemUpdater();
    }

    public function testQualityIncreasesByOneWhenSellInGreaterThanTen(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20);

        $this->updater->update($item);

        $this->assertEquals(14, $item->getSellIn());
        $this->assertEquals(21, $item->getQuality());
    }

    public function testQualityIncreasesByTwoWhenSellInBetweenSixAndTen(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20);

        $this->updater->update($item);

        $this->assertEquals(9, $item->getSellIn());
        $this->assertEquals(22, $item->getQuality());
    }

    public function testQualityIncreasesByThreeWhenSellInBetweenZeroAndFive(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20);

        $this->updater->update($item);

        $this->assertEquals(4, $item->getSellIn());
        $this->assertEquals(23, $item->getQuality());
    }

    public function testQualityDropsToZeroWhenSellInIsNegative(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20);

        $this->updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(0, $item->getQuality());
    }

    public function testQualityDoesNotExceedMaxQuality(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49);

        $this->updater->update($item);

        $this->assertEquals(4, $item->getSellIn());
        $this->assertEquals(50, $item->getQuality());
    }
}

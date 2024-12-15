<?php

declare(strict_types=1);

namespace Tests\Updater;

use App\Model\Item;
use App\Updater\DefaultItemUpdater;
use App\Updater\ItemUpdaterInterface;
use PHPUnit\Framework\TestCase;

final class DefaultItemUpdaterTest extends TestCase
{
    private ItemUpdaterInterface $updater;

    protected function setUp(): void
    {
        $this->updater = new DefaultItemUpdater();
    }

    public function testQualityDecreasesByOneWhenSellInIsPositive(): void
    {
        $item = new Item('Normal Item', 5, 10);

        $this->updater->update($item);

        $this->assertEquals(4, $item->getSellIn());
        $this->assertEquals(9, $item->getQuality());
    }

    public function testQualityDecreasesByTwoWhenSellInIsNegative(): void
    {
        $item = new Item('Normal Item', 0, 10);

        $this->updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(8, $item->getQuality());
    }

    public function testQualityDoesNotGoBelowZero(): void
    {
        $item = new Item('Normal Item', 3, 0);

        $this->updater->update($item);

        $this->assertEquals(2, $item->getSellIn());
        $this->assertEquals(0, $item->getQuality());
    }

    public function testQualityDecreasesByTwoWhenSellInIsNegativeAndQualityIsOne(): void
    {
        $item = new Item('Normal Item', 0, 1);

        $this->updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(0, $item->getQuality());
    }

    public function testSellInDecreasesEvenIfQualityIsZero(): void
    {
        $item = new Item('Normal Item', 2, 0);

        $this->updater->update($item);

        $this->assertEquals(1, $item->getSellIn());
        $this->assertEquals(0, $item->getQuality());
    }
}

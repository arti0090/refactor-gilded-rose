<?php

declare(strict_types=1);

namespace Tests\Updater;

use App\Model\Item;
use App\Updater\AgedBrieItemUpdater;
use App\Updater\ItemUpdaterInterface;
use PHPUnit\Framework\TestCase;

final class AgedBrieItemUpdaterTest extends TestCase
{
    private ItemUpdaterInterface $updater;

    protected function setUp(): void
    {
        $this->updater = new AgedBrieItemUpdater();
    }

    public function testQualityIncreasesWhenSellInIsPositive(): void
    {
        $item = new Item('Aged Brie', 10, 20);

        $this->updater->update($item);

        $this->assertEquals(9, $item->getSellIn());
        $this->assertEquals(21, $item->getQuality());
    }

    public function testQualityIncreasesTwiceWhenSellInIsNegative(): void
    {
        $item = new Item('Aged Brie', -1, 20);

        $this->updater->update($item);

        $this->assertEquals(-2, $item->getSellIn());
        $this->assertEquals(22, $item->getQuality());
    }

    public function testQualityDoesNotExceedMaxQuality(): void
    {
        $item = new Item('Aged Brie', 5, 50);

        $this->updater->update($item);

        $this->assertEquals(4, $item->getSellIn());
        $this->assertEquals(50, $item->getQuality());
    }

    public function testQualityIncreasesToMaxWhenCloseToMax(): void
    {
        $item = new Item('Aged Brie', 0, 49);

        $this->updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(50, $item->getQuality());
    }
}

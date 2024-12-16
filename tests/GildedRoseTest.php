<?php

declare(strict_types=1);

namespace Tests;

use App\GildedRose;
use App\Model\Item;
use App\Model\ItemType;
use PHPUnit\Framework\TestCase;

final class GildedRoseTest extends TestCase
{
    /** @dataProvider itemsProvider */
    public function testUpdateQualityTest(
        string $name,
        int $sellIn,
        int $quality,
        int $expectedSellIn,
        int $expectedQuality,
        string $itemType = ItemType::DEFAULT_ITEM_TYPE,
    ): void {
        $item = new Item($name, $sellIn, $quality, $itemType);

        $gildedRose = new GildedRose();
        $gildedRose->updateQuality($item);

        $this->assertEquals($expectedSellIn, $item->getSellIn());
        $this->assertEquals($expectedQuality, $item->getQuality());
    }

    public function itemsProvider(): array
    {
        return [
            'Aged Brie before sell in date' => ['Aged Brie', 10, 10, 9, 11, ItemType::APPRECIATING_ITEM_TYPE],
            'Aged Brie sell in date' => ['Aged Brie', 0, 10, -1, 12, ItemType::APPRECIATING_ITEM_TYPE],
            'Aged Brie after sell in date' => ['Aged Brie', -5, 10, -6, 12, ItemType::APPRECIATING_ITEM_TYPE],
            'Aged Brie before sell in date with maximum quality' => ['Aged Brie', 5, 50, 4, 50, ItemType::APPRECIATING_ITEM_TYPE],
            'Aged Brie sell in date near maximum quality' => ['Aged Brie', 0, 49, -1, 50, ItemType::APPRECIATING_ITEM_TYPE],
            'Aged Brie sell in date with maximum quality' => ['Aged Brie', 0, 50, -1, 50, ItemType::APPRECIATING_ITEM_TYPE],
            'Aged Brie after_sell in date with maximum quality' => ['Aged Brie', -10, 50, -11, 50, ItemType::APPRECIATING_ITEM_TYPE],
            'Backstage passes before sell in date' => ['Backstage passes to a TAFKAL80ETC concert', 10, 10, 9, 12, ItemType::EVENT_PASS_ITEM_TYPE],
            'Backstage passes more than 10 days before sell in date' => ['Backstage passes to a TAFKAL80ETC concert', 11, 10, 10, 11, ItemType::EVENT_PASS_ITEM_TYPE],
            'Backstage passes five days before sell in date' => ['Backstage passes to a TAFKAL80ETC concert', 5, 10, 4, 13, ItemType::EVENT_PASS_ITEM_TYPE],
            'Backstage passes sell in date' => ['Backstage passes to a TAFKAL80ETC concert', 0, 10, -1, 0, ItemType::EVENT_PASS_ITEM_TYPE],
            'Backstage passes close to sell in date with maximum quality' => ['Backstage passes to a TAFKAL80ETC concert', 10, 50, 9, 50, ItemType::EVENT_PASS_ITEM_TYPE],
            'Backstage passes very close to sell in date with maximum quality' => ['Backstage passes to a TAFKAL80ETC concert', 5, 50, 4, 50, ItemType::EVENT_PASS_ITEM_TYPE],
            'Backstage passes after sell in date' => ['Backstage passes to a TAFKAL80ETC concert', -5, 50, -6, 0, ItemType::EVENT_PASS_ITEM_TYPE],
            'Sulfuras before sell in date' => ['Sulfuras, Hand of Ragnaros', 10, 80, 10, 80, ItemType::LEGENDARY_ITEM_TYPE],
            'Sulfuras sell in date' => ['Sulfuras, Hand of Ragnaros', 0, 80, 0, 80, ItemType::LEGENDARY_ITEM_TYPE],
            'Sulfuras after sell in date' => ['Sulfuras, Hand of Ragnaros', -1, 80, -1, 80, ItemType::LEGENDARY_ITEM_TYPE],
            'Elixir of the Mongoose before sell in date' => ['Elixir of the Mongoose', 10, 10, 9, 9],
            'Elixir of the Mongoose sell in date' => ['Elixir of the Mongoose', 0, 10, -1, 8],
        ];
    }
}

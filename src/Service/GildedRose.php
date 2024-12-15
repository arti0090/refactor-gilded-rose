<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Item;
use App\Model\ItemQualityEnum;

final class GildedRose
{
    public const AGED_BRIE_ITEM = 'Aged Brie';
    public const BACKSTAGE_ITEM = 'Backstage passes to a TAFKAL80ETC concert';
    public const SULFURAS_ITEM = 'Sulfuras, Hand of Ragnaros';

    public function updateQuality(Item $item): void
    {
        if ($item->name !== self::AGED_BRIE_ITEM && $item->name !== self::BACKSTAGE_ITEM) {
            if ($item->quality > 0) {
                if ($item->name !== self::SULFURAS_ITEM) {
                    $item->quality--;
                } else {
                    $item->quality = ItemQualityEnum::LEGENDARY_QUALITY->value;
                }
            }
        } else {
            if ($item->quality < ItemQualityEnum::MAX_QUALITY->value) {
                $item->quality++;
                if ($item->name === self::BACKSTAGE_ITEM) {
                    if ($item->sell_in < 11) {
                        if ($item->quality < ItemQualityEnum::MAX_QUALITY->value) {
                            $item->quality++;
                        }
                    }
                    if ($item->sell_in < 6) {
                        if ($item->quality < ItemQualityEnum::MAX_QUALITY->value) {
                            $item->quality++;
                        }
                    }
                }
            }
        }

        if ($item->name !== self::SULFURAS_ITEM) {
            $item->sell_in--;
        }

        if ($item->sell_in < 0) {
            if ($item->name !== self::AGED_BRIE_ITEM) {
                if ($item->name !== self::BACKSTAGE_ITEM) {
                    if ($item->quality > 0) {
                        if ($item->name !== self::SULFURAS_ITEM) {
                            $item->quality--;
                        }
                    }
                } else {
                    $item->quality -= $item->quality;
                }
            } else {
                if ($item->quality < ItemQualityEnum::MAX_QUALITY->value) {
                    $item->quality++;
                }
            }
        }
    }
}

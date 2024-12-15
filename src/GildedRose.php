<?php

declare(strict_types=1);

namespace App;

use App\Factory\UpdaterFactory;
use App\Model\Item;

final class GildedRose
{
    public function updateQuality(Item $item): void
    {
        $updater = UpdaterFactory::createNew($item);
        $updater->update($item);
    }
}

<?php

namespace App\Updater;

use App\Model\Item;

interface ItemUpdaterInterface
{
    public function update(Item $item): void;
}

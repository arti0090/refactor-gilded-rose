<?php

declare(strict_types=1);

namespace App\Model;

// Note: From task description I could not get how much change I can do inside this Item file,
// but if available I would add property 'string $type' and by using it I would later choose the ItemUpdater to use f.e. (pseudocode)
// if Item->type is Legendary then in UpdaterFactory match, use LegendaryItemUpdater
final class Item
{
    public function __construct(
        private string $name,
        private int $sell_in,
        private int $quality,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSellIn(): int
    {
        return $this->sell_in;
    }

    public function setSellIn(int $sellIn): void
    {
        $this->sell_in = $sellIn;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function setQuality(int $quality): void
    {
        $this->quality = $quality;
    }

    public function __toString(): string
    {
        return "{$this->getName()}, {$this->getSellIn()}, {$this->getQuality()}";
    }
}

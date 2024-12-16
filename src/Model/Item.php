<?php

declare(strict_types=1);

namespace App\Model;

final class Item
{
    public function __construct(
        private string $name,
        private int $sell_in,
        private int $quality,
        private string $type = ItemType::DEFAULT_ITEM_TYPE,
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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function __toString(): string
    {
        return "{$this->getName()}, {$this->getSellIn()}, {$this->getQuality()}";
    }
}

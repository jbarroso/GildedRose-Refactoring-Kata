<?php

namespace GildedRose;

class InventoryItem
{
    public const MAX_QUALITY = 50;

    protected const DECREASE_QUALITY_VELOCITY = 1;

    protected Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateQuality(): void
    {
        $this->decreaseQuality();
        $this->decreaseSellIn();
        if ($this->hasExpired()) {
            $this->decreaseQuality();
        }
    }

    protected function increaseQuality(): void
    {
        if ($this->item->quality < self::MAX_QUALITY) {
            $this->item->quality = $this->item->quality + 1;
        }
    }

    protected function decreaseQuality(): void
    {
        $this->item->quality = max(0, $this->item->quality - static::DECREASE_QUALITY_VELOCITY);
    }

    protected function decreaseSellIn(): void
    {
        $this->item->sell_in = $this->item->sell_in - 1;
    }

    protected function hasExpired(): bool
    {
        return $this->item->sell_in < 0;
    }
}

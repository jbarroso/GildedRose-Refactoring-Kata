<?php

namespace GildedRose\InventoryItems;

class AgedBrieInventoryItem extends InventoryItem
{
    public const NAME = 'Aged Brie';

    public function updateQuality(): void
    {
        $this->increaseQuality();
        $this->decreaseSellIn();
        if ($this->hasExpired()) {
            $this->increaseQuality();
        }
    }
}

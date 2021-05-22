<?php


namespace GildedRose;


class AgedBrieInventoryItem extends InventoryItem
{
    public const NAME = 'Aged Brie';

    public function updateQuality(): void
    {
        $this->increaseQuality();
        $this->decreaseSellIn();
        if ($this->item->sell_in < 0) {
            $this->increaseQuality();
        }
    }


}
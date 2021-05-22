<?php


namespace GildedRose;


class BackstagePassInventoryItem extends InventoryItem
{
    public const NAME = 'Backstage passes to a TAFKAL80ETC concert';

    public function updateQuality(): void
    {
        $this->increaseQuality();
        if ($this->item->sell_in < 11) {
            $this->increaseQuality();
        }
        if ($this->item->sell_in < 6) {
            $this->increaseQuality();
        }
        $this->decreaseSellIn();
        if ($this->item->sell_in < 0) {
            $this->item->quality = 0;
        }
    }
}
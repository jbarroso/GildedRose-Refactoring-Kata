<?php

namespace GildedRose;

class BackstagePassInventoryItem extends InventoryItem
{
    public const NAME = 'Backstage passes to a TAFKAL80ETC concert';

    public function updateQuality(): void
    {
        $this->increaseQuality();
        if ($this->sellInLessOrEqualThan(10)) {
            $this->increaseQuality();
        }
        if ($this->sellInLessOrEqualThan(5)) {
            $this->increaseQuality();
        }
        $this->decreaseSellIn();
        if ($this->hasExpired()) {
            $this->item->quality = 0;
        }
    }

    private function sellInLessOrEqualThan(int $days): bool
    {
        return $this->item->sell_in <= $days;
    }
}

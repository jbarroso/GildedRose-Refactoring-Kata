<?php

namespace GildedRose\InventoryItems;

class BackstagePassInventoryItem extends InventoryItem
{
    public const NAME = 'Backstage passes to a TAFKAL80ETC concert';

    public const SELL_IN_TEN_DAYS = 10;

    public const SELL_IN_FIVE_DAYS = 5;

    public function updateQuality(): void
    {
        $this->increaseQuality();
        if ($this->sellInLessOrEqualThan(self::SELL_IN_TEN_DAYS)) {
            $this->increaseQuality();
        }
        if ($this->sellInLessOrEqualThan(self::SELL_IN_FIVE_DAYS)) {
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

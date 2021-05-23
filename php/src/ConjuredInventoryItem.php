<?php

namespace GildedRose;

class ConjuredInventoryItem extends InventoryItem
{
    public const NAME = 'Conjured Mana Cake';

    protected function decreaseQuality(): void
    {
        if ($this->item->quality > 0) {
            $this->item->quality = $this->item->quality - 2;
        }
    }
}

<?php

namespace GildedRose\InventoryItems;

class ConjuredInventoryItem extends InventoryItem
{
    public const NAME = 'Conjured Mana Cake';

    protected const DECREASE_QUALITY_VELOCITY = parent::DECREASE_QUALITY_VELOCITY * 2;
}

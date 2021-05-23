<?php

namespace GildedRose;

class InventoryItemFactory
{
    public static function create(Item $item): InventoryItem
    {
        switch ($item->name) {
            case SulfurasInventoryItem::NAME:
                return new SulfurasInventoryItem($item);
            case AgedBrieInventoryItem::NAME:
                return new AgedBrieInventoryItem($item);
            case BackstagePassInventoryItem::NAME:
                return new BackstagePassInventoryItem($item);
            case 'Conjured Mana Cake':
                return new ConjuredInventoryItem($item);
            default:
                return new InventoryItem($item);
        }
    }
}

<?php

namespace GildedRose;

use GildedRose\InventoryItems\AgedBrieInventoryItem;
use GildedRose\InventoryItems\BackstagePassInventoryItem;
use GildedRose\InventoryItems\ConjuredInventoryItem;
use GildedRose\InventoryItems\InventoryItem;
use GildedRose\InventoryItems\SulfurasInventoryItem;

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
            case ConjuredInventoryItem::NAME:
                return new ConjuredInventoryItem($item);
            default:
                return new InventoryItem($item);
        }
    }
}

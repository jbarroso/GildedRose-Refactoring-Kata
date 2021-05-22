<?php


namespace GildedRose;


class InventoryItemFactory
{

    public static function create(Item $item): InventoryItem
    {
        switch ($item->name) {
            case 'Sulfuras, Hand of Ragnaros':
                return new SulfurasInventoryItem($item);
            case 'Aged Brie':
                return new AgedBrieInventoryItem($item);
            case 'Backstage passes to a TAFKAL80ETC concert':
                return new BackstagePassInventoryItem($item);
            default:
                return new InventoryItem($item);
        }
    }
}
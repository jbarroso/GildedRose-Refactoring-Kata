<?php


namespace GildedRose;


class InventoryItemFactory
{

    public static function create(Item $item): InventoryItem
    {
        switch ($item->name) {
            case 'Sulfuras, Hand of Ragnaros':
                return new SulfurasInventoryItem($item);
            default:
                return new InventoryItem($item);
        }
    }
}
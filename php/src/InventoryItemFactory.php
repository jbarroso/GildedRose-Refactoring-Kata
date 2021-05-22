<?php


namespace GildedRose;


class InventoryItemFactory
{

    public static function create(Item $item): InventoryItem
    {
        return new InventoryItem($item);
    }
}
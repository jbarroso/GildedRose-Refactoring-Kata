<?php

namespace Tests;

use ApprovalTests\Approvals;
use ApprovalTests\CombinationApprovals;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class ApprovalTest extends TestCase
{
    public function testList(): void
    {
        $items = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('Aged Brie', 2, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
            // this conjured item does not work properly yet
            //new Item('Conjured Mana Cake', 3, 6),
        ];

        $app = new GildedRose($items);

        $days = 10;

        for ($i = 0; $i < $days; $i++) {
            $app->updateQuality();
        }
        Approvals::verifyList($items);
    }

    public function testCombinations(): void
    {
        $names = [
            '+5 Dexterity Vest',
            'Aged Brie',
            'Elixir of the Mongoose',
            'Sulfuras, Hand of Ragnaros',
            'Backstage passes to a TAFKAL80ETC concert',
            //'Conjured Mana Cake'
        ];
        $sellIns = range(-1, 15);
        $qualities = range(0, 80);

        CombinationApprovals::verifyAllCombinations3(function ($name, $sellIn, $quality) {
            $item = new Item($name, $sellIn, $quality);
            $app = new GildedRose([$item]);
            $app->updateQuality();
            return $item;
        }, $names, $sellIns, $qualities);
    }
}

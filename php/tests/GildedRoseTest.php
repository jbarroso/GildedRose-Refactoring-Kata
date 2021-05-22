<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testShouldDecreaseSellInByOneWithNormalItem(): void
    {
        // given
        $sellIn = 2;
        $item = new Item('foo', $sellIn, 0);

        // when
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();

        // then
        $this->assertSame($sellIn - 1, $item->sell_in);
    }

    public function testShouldDecreaseQualityByOneWithNormalItem(): void
    {
        // given
        $sellIn = 2;
        $quality = 3;
        $item = new Item('foo', $sellIn, $quality);

        // when
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();

        // then
        $this->assertSame($quality - 1, $item->quality);
    }

}

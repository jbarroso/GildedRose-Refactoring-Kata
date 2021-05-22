<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    const POSITIVE_SELL_IN = 2;
    const POSITIVE_QUALITY = 3;
    const NORMAL_ITEM = 'foo';

    public function testShouldDecreaseSellInByOneWithNormalItem(): void
    {
        // given
        $sellIn = self::POSITIVE_SELL_IN;
        $item = new Item(self::NORMAL_ITEM, $sellIn, 0);

        // when
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();

        // then
        $this->assertSame($sellIn - 1, $item->sell_in);
    }

    public function testShouldDecreaseQualityByOneWithNormalItem(): void
    {
        // given
        $sellIn = self::POSITIVE_SELL_IN;
        $quality = self::POSITIVE_QUALITY;
        $item = new Item(self::NORMAL_ITEM, $sellIn, $quality);

        // when
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();

        // then
        $this->assertSame($quality - 1, $item->quality);
    }

}

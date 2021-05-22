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
    private Item $item;

    public function testShouldDecreaseSellInByOneWithNormalItem(): void
    {
        // given
        $this->item = new Item(self::NORMAL_ITEM, self::POSITIVE_SELL_IN, self::POSITIVE_QUALITY);

        // when
        $gildedRose = new GildedRose([$this->item]);
        $gildedRose->updateQuality();

        // then
        $this->assertSame(self::POSITIVE_SELL_IN - 1, $this->item->sell_in);
    }

    public function testShouldDecreaseQualityByOneWithNormalItem(): void
    {
        // given
        $this->item = new Item(self::NORMAL_ITEM, self::POSITIVE_SELL_IN, self::POSITIVE_QUALITY);

        // when
        $gildedRose = new GildedRose([$this->item]);
        $gildedRose->updateQuality();

        // then
        $this->assertSame(self::POSITIVE_QUALITY - 1, $this->item->quality);
    }

}

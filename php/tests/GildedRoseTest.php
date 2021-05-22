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
        $this->givenItem(self::NORMAL_ITEM);

        $this->whenUpdateQuality();

        $this->thenSellInIsEqualTo(self::POSITIVE_SELL_IN - 1);
    }

    public function testShouldDecreaseQualityByOneWithNormalItem(): void
    {
        $this->givenItem(self::NORMAL_ITEM);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY - 1);
    }

    private function givenItem(string $name): void
    {
        $this->item = new Item($name, self::POSITIVE_SELL_IN, self::POSITIVE_QUALITY);
    }

    private function whenUpdateQuality(): void
    {
        $gildedRose = new GildedRose([$this->item]);
        $gildedRose->updateQuality();
    }

    private function thenSellInIsEqualTo(int $expectedSellIn): void
    {
        $this->assertSame($expectedSellIn, $this->item->sell_in);
    }

    private function thenQualityIsEqualTo(int $expectedQuality): void
    {
        $this->assertSame($expectedQuality, $this->item->quality);
    }
}

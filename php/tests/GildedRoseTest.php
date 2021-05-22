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
    const NEGATIVE_SELL_IN = -1;
    const ZERO_QUALITY = 0;
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

    public function testShouldDecreaseQualityByTwoWhenNormalItemHasExpired(): void
    {
        $this->givenItem(self::NORMAL_ITEM)
            ->withSellIn(self::NEGATIVE_SELL_IN);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY - 2);
    }

    public function testShouldNotDecreaseQualityWhenNormalItemQualityIsZero(): void
    {
        $this->givenItem(self::NORMAL_ITEM);
        $this->item->quality = self::ZERO_QUALITY;

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::ZERO_QUALITY);
    }

    private function givenItem(string $name): self
    {
        $this->item = new Item($name, self::POSITIVE_SELL_IN, self::POSITIVE_QUALITY);
        return $this;
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

    private function withSellIn(int $sellIn): void
    {
        $this->item->sell_in = $sellIn;
    }
}

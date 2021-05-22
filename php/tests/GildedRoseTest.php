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
    const AGED_BRIE_ITEM = 'Aged Brie';
    const SULFURAS_ITEM = 'Sulfuras, Hand of Ragnaros';
    const NEGATIVE_SELL_IN = -1;
    const ZERO_QUALITY = 0;
    const MAX_QUALITY = 50;
    private Item $item;

    public function testNormalItemShouldDecreaseSellInByOne(): void
    {
        $this->givenItem(self::NORMAL_ITEM);

        $this->whenUpdateQuality();

        $this->thenSellInIsEqualTo(self::POSITIVE_SELL_IN - 1);
    }

    public function testNormalItemShouldDecreaseQualityByOne(): void
    {
        $this->givenItem(self::NORMAL_ITEM);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY - 1);
    }

    public function testNormalItemShouldDecreaseQualityByTwoWhenItemHasExpired(): void
    {
        $this->givenItem(self::NORMAL_ITEM)
            ->withSellIn(self::NEGATIVE_SELL_IN);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY - 2);
    }

    public function testNormalItemShouldNotDecreaseQualityWhenQualityIsZero(): void
    {
        $this->givenItem(self::NORMAL_ITEM)
            ->withQuality(self::ZERO_QUALITY);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::ZERO_QUALITY);
    }

    public function testNormalItemShouldNotDecreaseQualityWhenQualityIsZeroAndItemHasExpired(): void
    {
        $this->givenItem(self::NORMAL_ITEM)
            ->withQuality(self::ZERO_QUALITY)
            ->withSellIn(self::NEGATIVE_SELL_IN);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::ZERO_QUALITY);
    }

    public function testAgedBrieShouldIncreaseQualityByOneWhenItemGetsOlder(): void
    {
        $this->givenItem(self::AGED_BRIE_ITEM);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY + 1);
    }

    public function testAgedBrieShouldIncreaseQualityByTwoWhenItemHasExpired(): void
    {
        $this->givenItem(self::AGED_BRIE_ITEM)
            ->withSellIn(self::NEGATIVE_SELL_IN);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY + 2);
    }

    public function testAgedBrieShouldNotIncreaseQualityWhenItReachesTheMaximumValue(): void
    {
        $this->givenItem(self::AGED_BRIE_ITEM)
            ->withQuality(self::MAX_QUALITY);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::MAX_QUALITY);
    }

    public function testAgedBrieShouldNotIncreaseQualityWhenItReachesTheMaximumValueAndItemHasExpired(): void
    {
        $this->givenItem(self::AGED_BRIE_ITEM)
            ->withQuality(self::MAX_QUALITY)
            ->withSellIn(self::NEGATIVE_SELL_IN);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::MAX_QUALITY);
    }

    public function testSulfurasShouldNotChangeSellIn(): void
    {
        $this->givenItem(self::SULFURAS_ITEM);

        $this->whenUpdateQuality();

        $this->thenSellInIsEqualTo(self::POSITIVE_SELL_IN);
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

    private function withSellIn(int $sellIn): self
    {
        $this->item->sell_in = $sellIn;
        return $this;
    }

    private function withQuality(int $quality): self
    {
        $this->item->quality = $quality;
        return $this;
    }
}

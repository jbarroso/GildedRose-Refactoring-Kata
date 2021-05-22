<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\AgedBrieInventoryItem;
use GildedRose\BackstagePassInventoryItem;
use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\SulfurasInventoryItem;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    private const NORMAL_ITEM = 'foo';

    private const POSITIVE_SELL_IN = 2;

    private const POSITIVE_QUALITY = 3;

    private const NEGATIVE_SELL_IN = -1;

    private const ZERO_QUALITY = 0;

    private const MAX_QUALITY = 50;

    private const SELL_IN_MORE_THAN_TEN_DAYS = 11;

    private const SELL_IN_TEN_DAYS = 10;

    private const SELL_IN_FIVE_DAYS = 5;

    private const SELL_IN_ZERO_DAYS = 0;

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
        $this->givenItem(AgedBrieInventoryItem::NAME);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY + 1);
    }

    public function testAgedBrieShouldIncreaseQualityByTwoWhenItemHasExpired(): void
    {
        $this->givenItem(AgedBrieInventoryItem::NAME)
            ->withSellIn(self::NEGATIVE_SELL_IN);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY + 2);
    }

    public function testAgedBrieShouldNotIncreaseQualityWhenItReachesTheMaximumValue(): void
    {
        $this->givenItem(AgedBrieInventoryItem::NAME)
            ->withQuality(self::MAX_QUALITY);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::MAX_QUALITY);
    }

    public function testAgedBrieShouldNotIncreaseQualityWhenItReachesTheMaximumValueAndItemHasExpired(): void
    {
        $this->givenItem(AgedBrieInventoryItem::NAME)
            ->withQuality(self::MAX_QUALITY)
            ->withSellIn(self::NEGATIVE_SELL_IN);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::MAX_QUALITY);
    }

    public function testSulfurasShouldNotChangeSellIn(): void
    {
        $this->givenItem(SulfurasInventoryItem::NAME);

        $this->whenUpdateQuality();

        $this->thenSellInIsEqualTo(self::POSITIVE_SELL_IN);
    }

    public function testSulfurasShouldNotChangeQuality(): void
    {
        $this->givenItem(SulfurasInventoryItem::NAME);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY);
    }

    public function testBackstagePassShouldIncreaseQualityByOneWhenSellInMoreThanTenDays(): void
    {
        $this->givenItem(BackstagePassInventoryItem::NAME)
            ->withSellIn(self::SELL_IN_MORE_THAN_TEN_DAYS);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY + 1);
    }

    public function testBackstagePassShouldIncreaseQualityByTwoWhenSellInTenDays(): void
    {
        $this->givenItem(BackstagePassInventoryItem::NAME)
            ->withSellIn(self::SELL_IN_TEN_DAYS);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY + 2);
    }

    public function testBackstagePassShouldIncreaseQualityByThreeWhenSellInFiveDays(): void
    {
        $this->givenItem(BackstagePassInventoryItem::NAME)
            ->withSellIn(self::SELL_IN_FIVE_DAYS);

        $this->whenUpdateQuality();

        $this->thenQualityIsEqualTo(self::POSITIVE_QUALITY + 3);
    }

    public function testBackstagePassShouldChangeQualityToZeroWhenItemHasExpired(): void
    {
        $this->givenItem(BackstagePassInventoryItem::NAME)
            ->withSellIn(self::SELL_IN_ZERO_DAYS);

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

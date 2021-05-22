<?php


namespace GildedRose;


class InventoryItem
{
    private Item $item;

    /**
     * InventoryItem constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateQuality(): void
    {
        if ($this->item->name == 'Sulfuras, Hand of Ragnaros') {
            return;
        }

        if ($this->item->name == 'Aged Brie') {
            $this->increaseQuality();
        } elseif ($this->item->name == 'Backstage passes to a TAFKAL80ETC concert') {
            $this->increaseQuality();
            if ($this->item->sell_in < 11) {
                $this->increaseQuality();
            }
            if ($this->item->sell_in < 6) {
                $this->increaseQuality();
            }
        } else {
            $this->decreaseQuality();
        }

        $this->item->sell_in = $this->item->sell_in - 1;

        if ($this->item->sell_in < 0) {
            if ($this->item->name == 'Aged Brie') {
                $this->increaseQuality();
            } else {
                if ($this->item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                    $this->item->quality = 0;
                } else {
                    $this->decreaseQuality();
                }
            }
        }
    }

    private function increaseQuality(): void
    {
        if ($this->item->quality < 50) {
            $this->item->quality = $this->item->quality + 1;
        }
    }

    private function decreaseQuality(): void
    {
        if ($this->item->quality > 0) {
            $this->item->quality = $this->item->quality - 1;
        }
    }
}
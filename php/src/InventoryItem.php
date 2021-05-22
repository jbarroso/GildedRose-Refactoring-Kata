<?php


namespace GildedRose;


class InventoryItem
{
    protected Item $item;

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
        if ($this->item->name == 'Backstage passes to a TAFKAL80ETC concert') {
            $this->increaseQuality();
            if ($this->item->sell_in < 11) {
                $this->increaseQuality();
            }
            if ($this->item->sell_in < 6) {
                $this->increaseQuality();
            }
            $this->decreaseSellIn();
            if ($this->item->sell_in < 0) {
                $this->item->quality = 0;
            }
        } else {
            $this->decreaseQuality();
            $this->decreaseSellIn();
            if ($this->item->sell_in < 0) {
                $this->decreaseQuality();
            }
        }
    }

    protected function increaseQuality(): void
    {
        if ($this->item->quality < 50) {
            $this->item->quality = $this->item->quality + 1;
        }
    }

    protected function decreaseQuality(): void
    {
        if ($this->item->quality > 0) {
            $this->item->quality = $this->item->quality - 1;
        }
    }

    protected function decreaseSellIn(): void
    {
        $this->item->sell_in = $this->item->sell_in - 1;
    }

}
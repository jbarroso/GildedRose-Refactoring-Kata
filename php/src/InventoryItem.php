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
        if ($this->item->name != 'Aged Brie' and $this->item->name != 'Backstage passes to a TAFKAL80ETC concert') {
            if ($this->item->quality > 0) {
                if ($this->item->name != 'Sulfuras, Hand of Ragnaros') {
                    $this->item->quality = $this->item->quality - 1;
                }
            }
        } else {
            if ($this->item->quality < 50) {
                $this->item->quality = $this->item->quality + 1;
                if ($this->item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($this->item->sell_in < 11) {
                        if ($this->item->quality < 50) {
                            $this->item->quality = $this->item->quality + 1;
                        }
                    }
                    if ($this->item->sell_in < 6) {
                        if ($this->item->quality < 50) {
                            $this->item->quality = $this->item->quality + 1;
                        }
                    }
                }
            }
        }

        if ($this->item->name != 'Sulfuras, Hand of Ragnaros') {
            $this->item->sell_in = $this->item->sell_in - 1;
        }

        if ($this->item->sell_in < 0) {
            if ($this->item->name != 'Aged Brie') {
                if ($this->item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($this->item->quality > 0) {
                        if ($this->item->name != 'Sulfuras, Hand of Ragnaros') {
                            $this->item->quality = $this->item->quality - 1;
                        }
                    }
                } else {
                    $this->item->quality = $this->item->quality - $this->item->quality;
                }
            } else {
                if ($this->item->quality < 50) {
                    $this->item->quality = $this->item->quality + 1;
                }
            }
        }
    }
}
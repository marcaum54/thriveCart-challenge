<?php

declare(strict_types=1);

namespace App;

use InvalidArgumentException;

final class Basket
{
    private array $items = [];

    public function __construct(
        private array $catalogue,
        private ShippingCalculator $shippingCalculator,
        protected array $offers = []
    ) {
    }

    public function add(string $productCode): void
    {
        //Validate that the product code exists in the catalogue and is a valid Product instance before adding it to the basket
        if (empty($this->catalogue[$productCode]) || !$this->catalogue[$productCode] instanceof Product) {
            throw new InvalidArgumentException("Product {$productCode} not found.");
        }

        $this->items[] = $this->catalogue[$productCode];
    }

    public function total(): float
    {
        $total = 0.0;

        //Summing the prices of all items in the basket
        foreach ($this->items as $product) {
            $total += $product->price;
        }

        //Apply offer discount if applicable
        foreach ($this->offers as $offer) {
            $total -= $offer->apply($this->items);
        }

        //Calculate shipping cost based on the subtotal after discounts
        $total += $this->shippingCalculator->calculate($total);

        //Return the final total including shipping, rounded to 2 decimal places
        return round($total, 2, PHP_ROUND_HALF_DOWN);
    }
}

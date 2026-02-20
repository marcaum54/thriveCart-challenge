<?php

declare(strict_types=1);

namespace App;

final class RedWidgetHalfPriceOffer
{
    private const PRODUCT_CODE_ELIGIBLE = 'R01';

    public function apply(array $items): float
    {
        //Filter the items to find all eligible products (Red Widgets)
        $eligible = array_values(array_filter(
            $items,
            fn (Product $product) => $product->code === self::PRODUCT_CODE_ELIGIBLE
        ));

        //If there are fewer than 2 eligible products, no discount applies
        if (count($eligible) < 2) {
            return 0.0;
        }

        $discount = 0.0;
        foreach ($eligible as $index => $product) {
            //Apply 50% discount to every second eligible product (i.e., the 2nd, 4th, etc.)
            if ($index % 2 === 1) {
                $discount += $product->price / 2;
            }
        }

        return $discount;
    }
}

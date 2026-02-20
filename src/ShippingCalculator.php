<?php

declare(strict_types=1);

namespace App;

final class ShippingCalculator
{
    private array $rules;

    public function __construct(array $rules)
    {
        //Guarantee that the shipping rules are sorted by threshold in ascending order
        ksort($rules);
        $this->rules = $rules;
    }

    public function calculate(float $subtotal): float
    {
        //Iterate through the shipping rules in order of threshold and return the cost for the first rule that matches
        foreach ($this->rules as $threshold => $cost) {
            if ($subtotal < $threshold) {
                return $cost;
            }
        }

        // If the subtotal exceeds all thresholds, shipping is free
        return 0.0;
    }
}

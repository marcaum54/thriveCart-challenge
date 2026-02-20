<?php

declare(strict_types=1);

use App\Product;
use App\Basket;
use App\ShippingCalculator;
use App\RedWidgetHalfPriceOffer;

beforeEach(function () {
    $this->basket = new Basket(
        [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ],
        new ShippingCalculator([
            50 => 4.95,
            90 => 2.95,
        ]),
        [
            new RedWidgetHalfPriceOffer()
        ]
    );
});

test('basket with (B01 + G01)', function () {
    $this->basket->add('B01');
    $this->basket->add('G01');

    expect($this->basket->total())->toBe(37.85);
});

test('basket with (R01 + R01)', function () {
    $this->basket->add('R01');
    $this->basket->add('R01');

    expect($this->basket->total())->toBe(54.37);
});

test('basket with (R01 + G01)', function () {
    $this->basket->add('R01');
    $this->basket->add('G01');

    expect($this->basket->total())->toBe(60.85);
});

test('complex basket with (B01 + B01 + R01 + R01 + R01)', function () {
    $this->basket->add('B01');
    $this->basket->add('B01');
    $this->basket->add('R01');
    $this->basket->add('R01');
    $this->basket->add('R01');

    expect($this->basket->total())->toBe(98.27);
});

## Project Overview

This PHP project implements a shopping cart with support for:
- Adding products to a basket
- Applying promotional discounts
- Calculating shipping costs based on order thresholds
- Computing the final order total

## Install and Run the Tests

```bash
composer install
./vendor/bin/pest tests
```

---

## Project Structure

### `/src` Directory

#### [Product.php](src/Product.php)
A simple immutable data class representing a product in the catalogue.

**Properties:**
- `code` (string) - Unique product identifier (e.g., 'R01')
- `name` (string) - Product display name
- `price` (float) - Product price

#### [Basket.php](src/Basket.php)
The main shopping cart class that manages items and calculates the final total.

---

#### [ShippingCalculator.php](src/ShippingCalculator.php)
Determines shipping costs based on order subtotal thresholds.

---

#### [RedWidgetHalfPriceOffer.php](src/RedWidgetHalfPriceOffer.php)
A promotional offer that applies a 50% discount to Red Widgets (product code 'R01').

---

### `/tests` Directory

#### [BasketTest.php](tests/BasketTest.php)
PHPUnit test suite for the Basket functionality based in the source of truth informed in the email:

| Products                | Total  |
|-------------------------|--------|
| B01, G01                | $37.85 |
| R01, R01                | $54.37 |
| R01, G01                | $60.85 |
| B01, B01, R01, R01, R01 | $98.27 |

---

## Dependencies

- **PHPUnit** - Unit testing framework
- **PEST** - The elegant PHP testing framework based in the PHPUnit
- **PHP 8.0+** - Requires modern PHP with strict typing and named arguments support

<?php
function formatPrice(
    float $value,
    string $currency = 'UAH',
    int $decimals = 2,
    string $thousandsSep = ' ',
    string $decimalSep = '.'
): string {
    $n = number_format($value, $decimals, $decimalSep, $thousandsSep);
    return $n . ' ' . $currency;
}

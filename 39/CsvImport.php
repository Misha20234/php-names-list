<?php
require_once __DIR__ . '/../08/Money.php';

final class Product {
    public function __construct(
        public int $id,
        public string $name,
        public Money $price
    ) {}
}

function parseProductsCsv(string $csv): array {
    $lines = preg_split('/\R/', trim($csv));
    if (!$lines || count($lines) === 0) {
        return [];
    }

    $header = str_getcsv(array_shift($lines));
    $out = [];

    foreach ($lines as $line) {
        if (trim($line) === '') {
            continue;
        }

        $row = str_getcsv($line);
        $item = [];
        foreach ($header as $i => $key) {
            $item[$key] = $row[$i] ?? null;
        }

        $id = (int)($item['id'] ?? 0);
        $name = (string)($item['name'] ?? '');
        $cents = (int)($item['price_cents'] ?? 0);
        $currency = (string)($item['currency'] ?? 'UAH');

        $out[] = new Product($id, $name, new Money($cents, $currency));
    }

    return $out;
}

function productsReport(array $products): array {
    $count = count($products);
    if ($count === 0) {
        return ['count' => 0, 'min' => null, 'max' => null, 'top3' => []];
    }

    $min = $products[0];
    $max = $products[0];

    foreach ($products as $p) {
        if ($p->price->getAmount() < $min->price->getAmount()) {
            $min = $p;
        }
        if ($p->price->getAmount() > $max->price->getAmount()) {
            $max = $p;
        }
    }

    $sorted = $products;
    usort($sorted, function($a, $b) {
        return $b->price->getAmount() <=> $a->price->getAmount();
    });

    $top3 = array_slice($sorted, 0, 3);

    return [
        'count' => $count,
        'min' => $min,
        'max' => $max,
        'top3' => $top3,
    ];
}

<?php
interface SortStrategy {
    public function sort(array $items): array;
}

final class SortByPrice implements SortStrategy {
    public function sort(array $items): array {
        $out = $items;
        usort($out, function($a, $b) {
            return ($a['price'] ?? 0) <=> ($b['price'] ?? 0);
        });
        return $out;
    }
}

final class SortByName implements SortStrategy {
    public function sort(array $items): array {
        $out = $items;
        usort($out, function($a, $b) {
            return strcmp((string)($a['name'] ?? ''), (string)($b['name'] ?? ''));
        });
        return $out;
    }
}

final class SortByRating implements SortStrategy {
    public function sort(array $items): array {
        $out = $items;
        usort($out, function($a, $b) {
            return ($b['rating'] ?? 0) <=> ($a['rating'] ?? 0);
        });
        return $out;
    }
}

final class CatalogSorter {
    public function __construct(private SortStrategy $strategy) {}

    public function setStrategy(SortStrategy $strategy): void {
        $this->strategy = $strategy;
    }

    public function sort(array $items): array {
        return $this->strategy->sort($items);
    }
}

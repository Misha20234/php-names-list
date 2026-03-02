<?php
require_once __DIR__ . '/../08/Money.php';

final class Product {
    public function __construct(
        public int $id,
        public string $name,
        public Money $price
    ) {}
}

interface LoggerInterface {
    public function info(string $msg): void;
    public function error(string $msg): void;
}

final class NullLogger implements LoggerInterface {
    public function info(string $msg): void {}
    public function error(string $msg): void {}
}

final class ProductRepository {
    private array $items = [];

    public function add(Product $p): void {
        $this->items[$p->id] = $p;
    }

    public function findById(int $id): ?Product {
        return $this->items[$id] ?? null;
    }

    public function searchByName(string $q): array {
        $q = trim(mb_strtolower($q, 'UTF-8'));
        $out = [];

        foreach ($this->items as $p) {
            $name = mb_strtolower($p->name, 'UTF-8');
            if ($q === '' || str_contains($name, $q)) {
                $out[] = $p;
            }
        }

        return $out;
    }
}

final class ProductSearchService {
    public function __construct(
        private ProductRepository $repo,
        private LoggerInterface $logger
    ) {}

    public function search(string $q): array {
        $this->logger->info('search: ' . $q);
        return $this->repo->searchByName($q);
    }
}

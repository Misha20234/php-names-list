<?php
require_once __DIR__ . '/../08/Money.php';

interface LoggerInterface {
    public function info(string $msg): void;
}

final class NullLogger implements LoggerInterface {
    public function info(string $msg): void {}
}

interface PriceProvider {
    public function getPrice(int $productId): Money;
}

final class SimplePriceProvider implements PriceProvider {
    public function __construct(private array $prices) {}

    public function getPrice(int $productId): Money {
        if (!array_key_exists($productId, $this->prices)) {
            throw new InvalidArgumentException('Unknown product');
        }
        return $this->prices[$productId];
    }
}

final class LoggingPriceProvider implements PriceProvider {
    public function __construct(
        private PriceProvider $inner,
        private LoggerInterface $logger
    ) {}

    public function getPrice(int $productId): Money {
        $this->logger->info('getPrice: ' . $productId);
        return $this->inner->getPrice($productId);
    }
}

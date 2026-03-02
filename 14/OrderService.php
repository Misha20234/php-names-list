<?php
require_once __DIR__ . '/../13/Logger.php';

final class OrderService {
    public function __construct(private LoggerInterface $logger) {}

    public function placeOrder(array $items): string {
        $orderId = 'ORD-' . uniqid();
        $this->logger->info('Order created: ' . $orderId . ', items=' . count($items));
        return $orderId;
    }
}

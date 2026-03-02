<?php
enum OrderStatus: string {
    case New = 'new';
    case Paid = 'paid';
    case Shipped = 'shipped';
    case Cancelled = 'cancelled';
}

final class Order {
    public function __construct(
        private int $id,
        private OrderStatus $status = OrderStatus::New
    ) {}

    public function getStatus(): OrderStatus {
        return $this->status;
    }

    public function transitionTo(OrderStatus $next): void {
        $allowed = [
            OrderStatus::New->value => [OrderStatus::Paid->value, OrderStatus::Cancelled->value],
            OrderStatus::Paid->value => [OrderStatus::Shipped->value, OrderStatus::Cancelled->value],
            OrderStatus::Shipped->value => [],
            OrderStatus::Cancelled->value => [],
        ];

        $cur = $this->status->value;
        $nextV = $next->value;

        if (!in_array($nextV, $allowed[$cur] ?? [], true)) {
            throw new InvalidArgumentException('Invalid status transition');
        }

        $this->status = $next;
    }
}

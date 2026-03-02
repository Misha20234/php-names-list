<?php
require_once __DIR__ . '/../08/Money.php';

final class PaymentResult {
    public function __construct(
        public bool $ok,
        public string $message,
        public ?string $transactionId = null
    ) {}
}

interface PaymentGateway {
    public function charge(Money $amount, array $meta = []): PaymentResult;
}

final class FakeGateway implements PaymentGateway {
    public function charge(Money $amount, array $meta = []): PaymentResult {
        return new PaymentResult(true, 'OK', 'tx_' . uniqid());
    }
}

final class FlakyGateway implements PaymentGateway {
    public function __construct(private int $failPercent = 30) {}

    public function charge(Money $amount, array $meta = []): PaymentResult {
        $p = $this->failPercent;
        if ($p < 0) { $p = 0; }
        if ($p > 100) { $p = 100; }

        $r = random_int(1, 100);
        if ($r <= $p) {
            throw new RuntimeException('Gateway error');
        }

        return new PaymentResult(true, 'OK', 'tx_' . uniqid());
    }
}

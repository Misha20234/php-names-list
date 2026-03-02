<?php
final class Money {
    public function __construct(
        private readonly int $amount,
        private readonly string $currency = 'UAH'
    ) {}

    public function getAmount(): int {
        return $this->amount;
    }

    public function getCurrency(): string {
        return $this->currency;
    }

    public function add(Money $other): Money {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException('Currency mismatch');
        }
        return new Money($this->amount + $other->amount, $this->currency);
    }

    public function subtract(Money $other): Money {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException('Currency mismatch');
        }
        return new Money($this->amount - $other->amount, $this->currency);
    }

    public function addMoney(Money $other): Money {
        return $this->add($other);
    }
}

<?php
require_once __DIR__ . '/../08/Money.php';

interface DiscountRule {
    public function apply(Money $price): Money;
}

final class PercentDiscount implements DiscountRule {
    public function __construct(private int $percent) {}

    public function apply(Money $price): Money {
        $p = $this->percent;
        if ($p < 0) { $p = 0; }
        if ($p > 100) { $p = 100; }

        $amount = $price->getAmount();
        $newAmount = (int)round($amount * (100 - $p) / 100);

        return new Money($newAmount, $price->getCurrency());
    }
}

final class FixedDiscount implements DiscountRule {
    public function __construct(private Money $minus) {}

    public function apply(Money $price): Money {
        if ($price->getCurrency() !== $this->minus->getCurrency()) {
            throw new InvalidArgumentException('Currency mismatch');
        }

        $newAmount = $price->getAmount() - $this->minus->getAmount();
        if ($newAmount < 0) { $newAmount = 0; }

        return new Money($newAmount, $price->getCurrency());
    }
}

final class DiscountEngine {
    public function __construct(private array $rules = []) {}

    public function apply(Money $price): Money {
        $cur = $price;

        foreach ($this->rules as $r) {
            if (!($r instanceof DiscountRule)) {
                throw new InvalidArgumentException('Not a DiscountRule');
            }
            $cur = $r->apply($cur);
        }

        return $cur;
    }
}

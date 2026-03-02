<?php
require_once __DIR__ . '/../08/Money.php';
require_once __DIR__ . '/../22/Discounts.php';

final class Product {
    public function __construct(
        public int $id,
        public string $name,
        public Money $price
    ) {}
}

final class CartItem {
    public function __construct(
        public Product $product,
        public int $qty
    ) {}
}

final class Cart {
    private array $items = [];
    private array $discountRules = [];

    public function add(Product $p, int $qty): void {
        if ($qty <= 0) {
            throw new InvalidArgumentException('qty must be > 0');
        }

        $id = $p->id;

        if (array_key_exists($id, $this->items)) {
            $this->items[$id]->qty += $qty;
            return;
        }

        $this->items[$id] = new CartItem($p, $qty);
    }

    public function remove(int $productId): void {
        unset($this->items[$productId]);
    }

    public function setDiscountRules(array $rules): void {
        $this->discountRules = $rules;
    }

    public function total(): Money {
        $currency = null;
        $sum = 0;

        foreach ($this->items as $it) {
            $cur = $it->product->price->getCurrency();
            if ($currency === null) {
                $currency = $cur;
            } elseif ($currency !== $cur) {
                throw new InvalidArgumentException('Currency mismatch');
            }
            $sum += $it->product->price->getAmount() * $it->qty;
        }

        $currency = $currency ?? 'UAH';
        $total = new Money($sum, $currency);

        $engine = new DiscountEngine($this->discountRules);
        return $engine->apply($total);
    }
}

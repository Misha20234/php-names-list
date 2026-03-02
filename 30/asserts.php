<?php
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_EXCEPTION, 1);

function mb_ucfirst_simple(string $s): string {
    $a = mb_substr($s, 0, 1, 'UTF-8');
    $b = mb_substr($s, 1, null, 'UTF-8');
    return mb_strtoupper($a, 'UTF-8') . $b;
}

function greet(string $name): string {
    $name = trim($name);
    if ($name === '') {
        return 'Привет, гость!';
    }
    $name = mb_strtolower($name, 'UTF-8');
    $name = mb_ucfirst_simple($name);
    return 'Привет, ' . $name . '!';
}

function safeDivide(float $a, float $b): float {
    if (abs($b) < 1e-12) {
        throw new InvalidArgumentException('Division by zero');
    }
    return round($a / $b, 4);
}

final class Money {
    public function __construct(
        private readonly int $amount,
        private readonly string $currency = 'UAH'
    ) {}

    public function getAmount(): int { return $this->amount; }
    public function getCurrency(): string { return $this->currency; }

    public function add(Money $other): Money {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException('Currency mismatch');
        }
        return new Money($this->amount + $other->amount, $this->currency);
    }
}

final class User {
    public function __construct(
        private int $id,
        private string $email,
        private string $name
    ) {
        $this->changeEmail($this->email);
        $this->name = trim($this->name);
    }

    public function changeEmail(string $email): void {
        $email = trim($email);
        $email = mb_strtolower($email, 'UTF-8');
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Invalid email');
        }
        $this->email = $email;
    }

    public function getEmail(): string { return $this->email; }
}

assert(greet('') === 'Привет, гость!');
assert(greet('   ') === 'Привет, гость!');
assert(greet('мИша') === 'Привет, Миша!');
assert(greet('ІВАН') === 'Привет, Іван!');

assert(abs(safeDivide(10, 4) - 2.5) < 0.0001);
assert(abs(safeDivide(1, 8) - 0.125) < 0.0001);
assert(abs(safeDivide(2, 3) - 0.6667) < 0.0001);

$m1 = new Money(100, 'UAH');
$m2 = new Money(50, 'UAH');
$m3 = $m1->add($m2);
assert($m3->getAmount() === 150);
assert($m3->getCurrency() === 'UAH');

$u = new User(1, 'TEST@EXAMPLE.COM', 'misha');
assert($u->getEmail() === 'test@example.com');

$thrown = false;
try { safeDivide(1, 0.0); } catch (InvalidArgumentException $e) { $thrown = true; }
assert($thrown === true);

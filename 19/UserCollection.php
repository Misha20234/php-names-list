<?php
require_once __DIR__ . '/../09/User.php';

final class UserCollection implements IteratorAggregate, Countable {
    private array $items = [];

    public function __construct(array $items = []) {
        foreach ($items as $u) {
            if (!($u instanceof User)) {
                throw new InvalidArgumentException('Not a User');
            }
            $this->items[] = $u;
        }
    }

    public function add(User $u): void {
        $this->items[] = $u;
    }

    public function findByEmail(string $email): ?User {
        $email = trim($email);
        $email = mb_strtolower($email, 'UTF-8');

        foreach ($this->items as $u) {
            $e = trim($u->getEmail());
            $e = mb_strtolower($e, 'UTF-8');
            if ($e === $email) {
                return $u;
            }
        }

        return null;
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->items);
    }

    public function count(): int {
        return count($this->items);
    }
}

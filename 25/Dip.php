<?php
require_once __DIR__ . '/../09/User.php';

interface UserRepository {
    public function save(User $u): void;
    public function find(int $id): ?User;
}

final class InMemoryUserRepository implements UserRepository {
    private array $items = [];

    public function save(User $u): void {
        $this->items[$u->getId()] = $u;
    }

    public function find(int $id): ?User {
        return $this->items[$id] ?? null;
    }
}

final class UserAppService {
    public function __construct(private UserRepository $repo) {}

    public function register(User $u): void {
        $this->repo->save($u);
    }

    public function getUser(int $id): ?User {
        return $this->repo->find($id);
    }
}

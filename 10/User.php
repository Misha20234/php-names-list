<?php
final class User {
    public function __construct(
        private int $id,
        private string $email,
        private string $name
    ) {
        $this->email = self::normalizeEmail($this->email);
        $this->name = self::normalizeName($this->name);
    }

    private static function normalizeEmail(string $email): string {
        $email = trim($email);
        $email = mb_strtolower($email, 'UTF-8');

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Invalid email');
        }

        return $email;
    }

    private static function mbUcfirst(string $s): string {
        $a = mb_substr($s, 0, 1, 'UTF-8');
        $b = mb_substr($s, 1, null, 'UTF-8');
        return mb_strtoupper($a, 'UTF-8') . $b;
    }

    private static function normalizeName(string $name): string {
        $name = trim($name);
        if ($name === '') {
            throw new InvalidArgumentException('Name is empty');
        }
        $name = mb_strtolower($name, 'UTF-8');
        return self::mbUcfirst($name);
    }

    public function getId(): int { return $this->id; }
    public function getEmail(): string { return $this->email; }
    public function getName(): string { return $this->name; }

    public static function fromArray(array $data): self {
        if (!array_key_exists('id', $data)) {
            throw new InvalidArgumentException('Missing key: id');
        }
        if (!array_key_exists('email', $data)) {
            throw new InvalidArgumentException('Missing key: email');
        }
        if (!array_key_exists('name', $data)) {
            throw new InvalidArgumentException('Missing key: name');
        }

        $id = $data['id'];
        if (is_string($id) && is_numeric($id)) {
            $id = (int)$id;
        }
        if (!is_int($id)) {
            throw new InvalidArgumentException('Invalid id');
        }

        return new self($id, (string)$data['email'], (string)$data['name']);
    }
}

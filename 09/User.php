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

    public function changeEmail(string $email): void {
        $this->email = self::normalizeEmail($email);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getName(): string {
        return $this->name;
    }
}

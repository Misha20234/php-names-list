<?php
require_once __DIR__ . '/RegisterUserDto.php';

final class RegisterUserValidator {
    public function validate(RegisterUserDto $dto): array {
        $errors = [];

        $email = trim($dto->email);
        $email = mb_strtolower($email, 'UTF-8');

        if ($email === '') {
            $errors[] = 'Email is empty';
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Invalid email';
        }

        if ($dto->password === '') {
            $errors[] = 'Password is empty';
        }

        $name = trim($dto->name);
        if ($name === '') {
            $errors[] = 'Name is empty';
        }

        return $errors;
    }
}

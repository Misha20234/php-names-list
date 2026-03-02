<?php
function validateEmail(string $email): array {
    $email = trim($email);
    $email = mb_strtolower($email, 'UTF-8');

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return ['ok' => false, 'email' => null];
    }

    return ['ok' => true, 'email' => $email];
}

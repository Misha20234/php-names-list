<?php
require_once __DIR__ . '/../09/User.php';

final class UserFactory {
    public static function fromArray(array $data): User {
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

        return new User($id, (string)$data['email'], (string)$data['name']);
    }
}

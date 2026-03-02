<?php
final class RegisterUserDto {
    public function __construct(
        public string $email,
        public string $password,
        public string $name
    ) {}
}

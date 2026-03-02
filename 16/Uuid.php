<?php
final class Uuid {
    public function __construct(private string $value) {
        $v = trim($this->value);
        $v = mb_strtolower($v, 'UTF-8');

        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $v)) {
            throw new InvalidArgumentException('Invalid UUID');
        }

        $this->value = $v;
    }

    public function __toString(): string {
        return $this->value;
    }
}

<?php
final class Config {
    private static array $data = [];

    public static function set(string $key, mixed $value): void {
        $parts = explode('.', $key);
        $ref = &self::$data;

        foreach ($parts as $p) {
            if (!is_array($ref)) {
                $ref = [];
            }
            if (!array_key_exists($p, $ref) || !is_array($ref[$p])) {
                $ref[$p] = $ref[$p] ?? [];
            }
            $ref = &$ref[$p];
        }

        $ref = $value;
    }

    public static function get(string $key, mixed $default = null): mixed {
        $parts = explode('.', $key);
        $cur = self::$data;

        foreach ($parts as $p) {
            if (!is_array($cur) || !array_key_exists($p, $cur)) {
                return $default;
            }
            $cur = $cur[$p];
        }

        return $cur;
    }
}

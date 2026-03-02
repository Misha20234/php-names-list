<?php
function fib(int $n): int {
    if ($n < 0 || $n > 92) {
        throw new InvalidArgumentException('n out of range');
    }

    static $cache = [0 => 0, 1 => 1];

    if (array_key_exists($n, $cache)) {
        return $cache[$n];
    }

    $cache[$n] = fib($n - 1) + fib($n - 2);
    return $cache[$n];
}

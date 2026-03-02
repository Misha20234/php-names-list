<?php
function safeDivide(float $a, float $b): float {
    if (abs($b) < 1e-12) {
        throw new InvalidArgumentException('Division by zero');
    }
    return round($a / $b, 4);
}

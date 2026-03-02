<?php
function myMap(array $items, callable $fn): array {
    $out = [];
    foreach ($items as $k => $v) {
        $out[$k] = $fn($v, $k);
    }
    return $out;
}

function myFilter(array $items, callable $predicate): array {
    $out = [];
    foreach ($items as $k => $v) {
        if ($predicate($v, $k)) {
            $out[$k] = $v;
        }
    }
    return $out;
}

function myReduce(array $items, callable $reducer, mixed $initial): mixed {
    $acc = $initial;
    foreach ($items as $k => $v) {
        $acc = $reducer($acc, $v, $k);
    }
    return $acc;
}

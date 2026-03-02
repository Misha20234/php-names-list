<?php
function mb_ucfirst_simple(string $s): string {
    $a = mb_substr($s, 0, 1, 'UTF-8');
    $b = mb_substr($s, 1, null, 'UTF-8');
    return mb_strtoupper($a, 'UTF-8') . $b;
}

function greet(string $name): string {
    $name = trim($name);
    if ($name === '') {
        return 'Привет, гость!';
    }
    $name = mb_strtolower($name, 'UTF-8');
    $name = mb_ucfirst_simple($name);
    return 'Привет, ' . $name . '!';
}

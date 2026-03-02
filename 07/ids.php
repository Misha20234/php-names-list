<?php
function &idState(): int {
    static $i = 0;
    return $i;
}

function nextId(): int {
    $i = &idState();
    $i = $i + 1;
    return $i;
}

function resetId(): void {
    $i = &idState();
    $i = 0;
}

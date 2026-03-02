<?php
function logLine(string $level, string ...$parts): string {
    $head = '[' . $level . ']';
    if (count($parts) === 0) {
        return $head;
    }
    return $head . ' ' . implode(' | ', $parts);
}

<?php
function readLines(string $path): Generator {
    $h = fopen($path, 'rb');
    if (!$h) {
        throw new RuntimeException('Cannot open file');
    }

    try {
        while (!feof($h)) {
            $line = fgets($h);
            if ($line === false) {
                break;
            }
            yield $line;
        }
    } finally {
        fclose($h);
    }
}

<?php
$task = $argv[1] ?? '';

$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir);
}

$fileSer = $dataDir . '/compare.ser';
$fileJson = $dataDir . '/compare.json';

if ($task == '24') {
    $arr = ["name" => "Misha", "skills" => ["php", "files", "json"], "active" => true];
    file_put_contents($fileSer, serialize($arr));
    file_put_contents($fileJson, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "OK\n";
} elseif ($task == '25') {
    if (file_exists($fileSer) && file_exists($fileJson)) {
        echo filesize($fileSer) . "\n";
        echo filesize($fileJson) . "\n";
    } else {
        echo "NO_FILE\n";
    }
} else {
    echo "php block5_compare.php 24|25\n";
}
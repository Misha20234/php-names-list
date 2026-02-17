<?php
$task = $argv[1] ?? '';

$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir);
}

$fileEmpty = $dataDir . '/empty.txt';
$fileBad = $dataDir . '/bad.json';
$fileLog = $dataDir . '/log.txt';

function addLog($fileLog, $text) {
    file_put_contents($fileLog, date("Y-m-d H:i:s") . " - " . $text . "\n", FILE_APPEND);
}

if ($task == '26') {
    file_put_contents($fileEmpty, "");
    echo strlen(file_get_contents($fileEmpty)) . "\n";
} elseif ($task == '27') {
    file_put_contents($fileBad, "{ invalid json ");
    json_decode(file_get_contents($fileBad), true);
    if (json_last_error() != JSON_ERROR_NONE) {
        echo json_last_error_msg() . "\n";
    } else {
        echo "OK\n";
    }
} elseif ($task == '28') {
    $fileName = $argv[2] ?? 'empty.txt';
    $path = $dataDir . '/' . $fileName;
    if (file_exists($path)) {
        echo strlen(file_get_contents($path)) . "\n";
    } else {
        echo "NO_FILE\n";
    }
} elseif ($task == '29') {
    $path = $dataDir . '/safe_write.txt';
    $tmp = $dataDir . '/safe_write_tmp.txt';
    file_put_contents($tmp, "Saved at " . date("Y-m-d H:i:s") . "\n");
    rename($tmp, $path);
    echo "OK\n";
} elseif ($task == '30') {
    addLog($fileLog, "action");
    echo "OK\n";
} else {
    echo "php block6_safety.php 26|27|28|29|30\n";
}
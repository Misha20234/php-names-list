<?php
$task = $argv[1] ?? '';

$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir);
}

$fileNumbers = $dataDir . '/numbers.ser';
$fileProfile = $dataDir . '/profile.ser';

if ($task == '8') {
    $numbers = [1, 2, 3, 4, 5];
    file_put_contents($fileNumbers, serialize($numbers));
    echo "OK\n";
} elseif ($task == '9') {
    if (file_exists($fileNumbers)) {
        $arr = unserialize(file_get_contents($fileNumbers));
        print_r($arr);
    } else {
        echo "NO_FILE\n";
    }
} elseif ($task == '10') {
    $profile = ["name" => "Misha", "age" => 18, "city" => "Kyiv"];
    file_put_contents($fileProfile, serialize($profile));
    echo "OK\n";
} elseif ($task == '11') {
    if (file_exists($fileProfile)) {
        $profile = unserialize(file_get_contents($fileProfile));
        $profile["age"] = $profile["age"] + 1;
        $profile["updated_at"] = date("Y-m-d H:i:s");
        file_put_contents($fileProfile, serialize($profile));
        print_r($profile);
    } else {
        echo "NO_FILE\n";
    }
} elseif ($task == '12') {
    if (file_exists($fileProfile)) {
        $size = filesize($fileProfile);
        echo ($size > 0) ? "EXISTS_NOT_EMPTY\n" : "EXISTS_EMPTY\n";
    } else {
        echo "NOT_EXISTS\n";
    }
} else {
    echo "php block2_serialize.php 8|9|10|11|12\n";
}
<?php
$task = $argv[1] ?? '';

$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir);
}

$fileColors = $dataDir . '/colors.json';
$fileCities = $dataDir . '/cities.json';
$filePretty = $dataDir . '/pretty.json';

if ($task == '13') {
    $colors = ["red", "green", "blue"];
    file_put_contents($fileColors, json_encode($colors));
    echo "OK\n";
} elseif ($task == '14') {
    if (file_exists($fileColors)) {
        $arr = json_decode(file_get_contents($fileColors), true);
        print_r($arr);
    } else {
        echo "NO_FILE\n";
    }
} elseif ($task == '15') {
    $cities = [
        ["city" => "Kyiv", "population" => 2967000],
        ["city" => "Lviv", "population" => 717000]
    ];
    file_put_contents($fileCities, json_encode($cities));
    echo "OK\n";
} elseif ($task == '16') {
    $data = ["site" => "Example", "features" => ["files", "json", "serialize"]];
    file_put_contents($filePretty, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "OK\n";
} elseif ($task == '17') {
    if (file_exists($fileColors)) {
        $colors = json_decode(file_get_contents($fileColors), true);
        if (!is_array($colors)) $colors = [];
        $colors[] = "black";
        file_put_contents($fileColors, json_encode($colors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        print_r($colors);
    } else {
        echo "NO_FILE\n";
    }
} elseif ($task == '18') {
    if (file_exists($fileColors)) {
        $colors = json_decode(file_get_contents($fileColors), true);
        $index = array_search("green", $colors, true);
        if ($index !== false) {
            unset($colors[$index]);
            $colors = array_values($colors);
        }
        file_put_contents($fileColors, json_encode($colors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        print_r($colors);
    } else {
        echo "NO_FILE\n";
    }
} else {
    echo "php block3_json.php 13|14|15|16|17|18\n";
}
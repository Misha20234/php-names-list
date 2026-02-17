<?php
$task = $argv[1] ?? '';

$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir);
}

$fileSettings = $dataDir . '/settings.json';
$fileNotes = $dataDir . '/notes.json';
$fileNumbersSer = $dataDir . '/numbers.ser';
$fileExport = $dataDir . '/numbers_from_serialize.json';

if ($task == '31') {
    $settings = ["site_name" => "My Site", "maintenance" => false, "theme" => "dark"];
    file_put_contents($fileSettings, json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "OK\n";
} elseif ($task == '32') {
    $key = $argv[2] ?? '';
    $value = $argv[3] ?? '';
    if ($key == '') { echo "ARGS\n"; exit; }

    $settings = [];
    if (file_exists($fileSettings) && trim(file_get_contents($fileSettings)) != '') {
        $settings = json_decode(file_get_contents($fileSettings), true);
        if (!is_array($settings)) $settings = [];
    }

    if ($value === "true") $value = true;
    if ($value === "false") $value = false;

    $settings[$key] = $value;
    file_put_contents($fileSettings, json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "OK\n";
} elseif ($task == '33') {
    $action = $argv[2] ?? '';

    $notes = [];
    if (file_exists($fileNotes) && trim(file_get_contents($fileNotes)) != '') {
        $notes = json_decode(file_get_contents($fileNotes), true);
        if (!is_array($notes)) $notes = [];
    }

    if ($action == 'add') {
        $text = $argv[3] ?? '';
        if ($text == '') { echo "ARGS\n"; exit; }
        $notes[] = $text;
        file_put_contents($fileNotes, json_encode($notes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo "OK\n";
    } elseif ($action == 'list') {
        print_r($notes);
    } else {
        echo "ARGS\n";
    }
} elseif ($task == '34') {
    file_put_contents($fileNotes, "");
    echo "OK\n";
} elseif ($task == '35') {
    if (!file_exists($fileNumbersSer)) { echo "NO_FILE\n"; exit; }
    $arr = unserialize(file_get_contents($fileNumbersSer));
    file_put_contents($fileExport, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "OK\n";
} else {
    echo "php block7_combo.php 31|32|33|34|35\n";
}
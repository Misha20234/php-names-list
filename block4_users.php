<?php
$task = $argv[1] ?? '';

$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir);
}

$fileUsers = $dataDir . '/users.json';

function loadUsers($fileUsers) {
    if (!file_exists($fileUsers)) return [];
    $json = file_get_contents($fileUsers);
    if (trim($json) == '') return [];
    $users = json_decode($json, true);
    if (!is_array($users)) return [];
    return $users;
}

function saveUsers($fileUsers, $users) {
    file_put_contents($fileUsers, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

if ($task == '19') {
    saveUsers($fileUsers, []);
    echo "OK\n";
} elseif ($task == '20') {
    $name = $argv[2] ?? '';
    $email = $argv[3] ?? '';
    if ($name == '' || $email == '') { echo "ARGS\n"; exit; }

    $users = loadUsers($fileUsers);
    $id = count($users) + 1;

    $users[] = ["id" => $id, "name" => $name, "email" => $email];
    saveUsers($fileUsers, $users);
    echo "OK\n";
} elseif ($task == '21') {
    $users = loadUsers($fileUsers);
    print_r($users);
} elseif ($task == '22') {
    $name = $argv[2] ?? '';
    if ($name == '') { echo "ARGS\n"; exit; }

    $users = loadUsers($fileUsers);
    $found = [];
    foreach ($users as $u) {
        if (isset($u["name"]) && strtolower($u["name"]) == strtolower($name)) {
            $found[] = $u;
        }
    }
    if (!$found) echo "NOT_FOUND\n";
    print_r($found);
} elseif ($task == '23') {
    $users = loadUsers($fileUsers);
    echo count($users) . "\n";
} else {
    echo "php block4_users.php 19|20|21|22|23\n";
}
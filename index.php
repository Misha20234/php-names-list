<?php
$names = ["Андрей", "Миша", "Оля", "Ира", "Саша", "Дима", "Катя", "Влад", "Юля", "Назар"];

// 1) Путь к файлу кеша (лежит рядом с index.php)
$cacheFile = __DIR__ . "/cache.json"; 
// __DIR__ — это папка, где находится текущий файл PHP

$pickCount = 5;     // сколько элементов выбирать
$selected = null;   // сюда положим результат (массив имён)

// 2) Проверяем: есть ли кеш-файл
if (file_exists($cacheFile)) {
  // 3) Если есть — читаем содержимое файла
  $json = file_get_contents($cacheFile); // читает весь файл как строку

  // превращаем JSON-строку обратно в массив PHP
  $data = json_decode($json, true); 
  // true => вернёт массив, а не объект

  // 4) Проверяем что данные выглядят нормально
  if (is_array($data) && count($data) > 0) {
    $selected = $data; // берём из кеша и НЕ делаем рандом
  }
}

// 5) Если кеша нет или он плохой — делаем случайную выборку и сохраняем
if ($selected === null) {
  // array_rand вернёт массив ключей (потому что pickCount = 5)
  $keys = array_rand($names, $pickCount);

  $selected = []; // сюда сложим выбранные имена

  $i = 0;
  while ($i < count($keys)) {
    $key = $keys[$i];          // очередной ключ
    $selected[] = $names[$key]; // добавляем выбранное имя в массив
    $i++;
  }

  // превращаем массив в JSON-строку
  $jsonToSave = json_encode($selected, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  // JSON_UNESCAPED_UNICODE — чтобы кириллица не превращалась в \u0410...
  // JSON_PRETTY_PRINT — чтобы красиво в столбик

  // сохраняем в файл
  file_put_contents($cacheFile, $jsonToSave);
}

// 6) Вывод результата (одинаковый — из кеша или новый)
echo "<h3>Выбранные элементы:</h3>";
echo "<ul>";

$i = 0;
while ($i < count($selected)) {
  echo "<li>{$selected[$i]}</li>";
  $i++;
}

echo "</ul>";
?>

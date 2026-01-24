<?php
$names = ["Андрей", "Миша", "Оля", "Ира", "Саша", "Дима", "Катя", "Влад", "Юля", "Назар"];
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Список имён</title>
</head>
<body>

<h1>Список имён</h1>

<ul>
  <?php foreach ($names as $name): ?>
    <li><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></li>
  <?php endforeach; ?>
</ul>

</body>
</html>


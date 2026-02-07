<?php
$names = ["Андрей", "Миша", "Оля", "Ира", "Саша", "Дима", "Катя", "Влад", "Юля", "Назар"];
$keys = array_rand($names,5);
$i = 0;
while($i < count($keys)){
$key = $names[$keys[$i]];
echo $key . "\n";
$i++;
};


<?php


file_put_contents("hello.txt", "Hello, world!");
echo "Записал\n";


$text = file_get_contents("hello.txt");
echo "Прочитал: " . $text . "\n";


$text1 = file_put_contents("hello.txt", "New text");
echo "Перезаписал :" . $text1 . "\n";


file_put_contents("hello.txt", " Appended text", FILE_APPEND);
echo "Добавилt\n";


$n = "\nHi\nwhy?\nwhat why?\n"; 
file_put_contents("hello.txt", $n, FILE_APPEND);
echo "Добавил x2\n";

$lines = file("hello.txt");
echo "Строк: " . count($lines) . "\n";
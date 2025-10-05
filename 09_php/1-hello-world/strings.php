<?php

$name = 'Francisco';
$message = "Welcome to PHP, $name!";
$string1 = "Hello, $name!";
$string2 = '               Hello, $name!';

echo $string2;
echo "\n";

echo strlen($string1) . "\n";
echo strtoupper($string1) . "\n";
echo strtolower($string1) . "\n";
echo strpos($string1, '!') . "\n";
echo substr($string1, 7, 9) . "\n";
echo str_replace('!', ' :)', $string1) . "\n";
echo trim($string2) . "\n";
$words = explode(' ', $message);
var_dump($words);
echo implode('-', $words) . "\n";

$string3 = "Olá, isto é uma string.\nEsta string tem múltiplas linhas.\nE acentos: á, é, í, ó, ú, ã, õ, â, ê, ô, ç.";
echo nl2br($string3);

$text1 = <<<HTML
    <h1>Hello, $name!</h1>
    <p>Welcome to PHP!</p>
HTML;
echo $text1;

$text2 = <<<'HTML'
    <h1>Hello, $name!</h1>
    <p>Welcome to PHP!</p>
HTML;
echo $text2;

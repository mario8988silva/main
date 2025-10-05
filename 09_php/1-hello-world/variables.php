<?php

$name = 'Francisco';
$age = 39;

echo $name;
echo $age;

function greet()
{
    // $name = 'Zebedeu';
    global $name;

    echo $name;
}

echo $name;

greet();

echo "\n\n";

function counter()
{
    static $count = 1;
    echo $count++;
}

counter();
counter();
counter();
counter();

function greet2(string $n)
{
    echo "Hello, $n";
}

greet2('Maria');
// echo $n;

var_dump($name);
var_dump($age);
var_dump(is_string($name));
var_dump(is_int($age));
var_dump(is_float($age));

echo gettype($name);

function sum(int $a, int $b): int
{
    return $a + $b;
}

echo sum(1, 2);
echo "\n\n";

$x = 5;
echo $x++ + ++$x;
echo $x;

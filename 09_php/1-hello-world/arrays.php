<?php

$names = array("Peter", "Joe", "Glenn", "Cleveland");
$names = ["Peter", "Joe", "Glenn", "Cleveland"];

echo $names[0];
print_r($names);
var_dump($names);

$person = [
    "first_name" => "Peter",
    "last_name" => "Griffin",
    "age" => 41,
    "children" => ["Chris", "Meg", "Stewie"]
];
print_r($person);
echo $person["first_name"];
echo $person["children"][1];

$list = [
    ["id" => 1, "name" => "Peter"],
    ["id" => 2, "name" => "Joe"],
    ["id" => 3, "name" => "Glenn"]
];
print_r($list);
$peter = $list[0];
echo $peter["name"];

foreach ($list as $item) {
    echo $item["id"] . ": " . $item["name"] . "\n";
}

foreach ($person as $key => $value) {
    if (is_array($value)) {
        echo "$key: " . implode(", ", $value) . "\n";
    } else {
        echo "$key: $value\n";
    }
}

echo count($names) . "\n";
echo sizeof($names) . "\n";

array_push($names, "Lois");
print_r($names);
$names[] = "Brian";
print_r($names);

$removed = array_pop($names);
print_r($names);
echo $removed;

array_unshift($names, "Quagmire");
print_r($names);

$removed = array_shift($names);
print_r($names);
echo $removed;

print_r(array_keys($person));
print_r(array_values($person));
// array_map()
// array_reduce()
// array_filter()

// const numbers = [1, 2, 3, 4, 5];
// const doubles = numbers.map(n => n * 2);

function map(array $data, callable $fn)
{
    $result = [];

    foreach ($data as $item) {
        $result[] = $fn($item);
    }

    return $result;
}

$numbers = [1, 2, 3, 4, 5];
$doubles = map($numbers, fn($n) => $n * 2);
print_r($doubles);
print_r($numbers);

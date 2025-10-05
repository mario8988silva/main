<?php

// $number = rand(1, 10);

// if ($number >= 1 && $number <= 5) {
//     echo "The number $number is between 1 and 5\n";
// } elseif ($number >= 6 && $number <= 8) {
//     echo "The number $number is between 6 and 8\n";
// } else {
//     echo "The number $number is between 9 and 10\n";
// }

// for ($i = 0, $j = 0, $k = 20; $i < 10; $i++, $k++) {
//     echo "Iteration $i $k\n";
// }

// $i = 0;
// while ($i++ < 10) {
//     echo "Iteration $i\n";
// }

function iterarNumero($i, $max = 10)
{
    if ($i > $max) {
        return;
    }

    echo "Iteration $i\n";
    iterarNumero($i + 1, $max);
}

iterarNumero(1, 10);

$names = ['Ana', 'Maria', 'João', 'Pedro'];
foreach ($names as $index => $name) {
    echo "$index -> Hello, $name\n";
}

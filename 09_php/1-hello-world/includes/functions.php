<?php

function sum(float ...$numbers): float
{
    // $total = 0;

    // foreach ($numbers as $n) {
    //     $total += $n;
    // }

    // return $total;
    // return array_reduce($numbers, fn($acc, $n) => $acc + $n, 0);
    return array_sum($numbers);
}

function sub(float ...$numbers): float
{
    return array_reduce($numbers, fn($acc, $n) => $acc - $n);
}

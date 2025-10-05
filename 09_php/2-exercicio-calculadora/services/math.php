<?php

function sum(float ...$numbers): float
{
    return array_sum($numbers);
}

function sub(float ...$numbers): float
{
    $first = array_shift($numbers);
    return array_reduce($numbers, fn($acc, $number) => $acc - $number, $first);
}

function multiply(float ...$numbers): float
{
    $first = array_shift($numbers);
    return array_reduce($numbers, fn($acc, $number) => $acc * $number, $first);
}

function divide(float ...$numbers): float
{
    $first = array_shift($numbers);
    return array_reduce($numbers, fn($acc, $number) => $acc / $number, $first);
}

/**
 * 2^3 = 2 * 2 * 2
 * 2^0 = 1
 * 2^-3 = 1 / 2^3 = 1 / (2 * 2 * 2)
 */
function power(float $base, float $exponent): float
{
    // return pow($base, $exponent);
    // return $base ** $exponent;

    $result = 1;
    $absExponent = $exponent < 0 ? $exponent * -1 : $exponent;

    while ($absExponent-- > 0) {
        $result *= $base;
    }

    return $exponent < 0 ? 1 / $result : $result;
}

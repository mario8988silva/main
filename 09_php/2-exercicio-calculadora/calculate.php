<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    // header("HTTP/1.1 405 Method Not Allowed");
    die('Method Not Allowed');
}

require_once 'services/math.php';

$numbers = $_POST['numbers'] ?? [];
$operation = $_POST['operation'] ?? null;

$total = match ($operation) {
    'add' => sum(...$numbers),
    'subtract' => sub(...$numbers),
    'multiply' => multiply(...$numbers),
    'divide' => divide(...$numbers),
    'power' => power($numbers[0], $numbers[1]),
    default => null,
};

header("Location: index.php?result=$total&numbers=" . implode(',', $numbers) . "&operation=$operation");

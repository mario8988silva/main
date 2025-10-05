<?php

$result = $_GET['result'] ?? null;
$numbers = isset($_GET['numbers']) ? explode(',', $_GET['numbers']) : [null, null];
$operation = $_GET['operation'] ?? null;

function markSelected($value): string
{
    global $operation;
    return $value === $operation ? 'selected' : '';
}

include 'views/form.view.phtml';

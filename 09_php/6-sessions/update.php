<?php

session_start();

$_SESSION['counter'] += 1;
$counter = $_SESSION['counter'];
$message = "Counter updated. New value: $counter.";
header("Location: index.php?message=$message");
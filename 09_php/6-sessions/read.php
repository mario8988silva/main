<?php

session_start();

$counter = $_SESSION['counter'] ?? null;
$message = "Session ID: " . session_id();

if (!is_null($counter)) {
    $message .= " | Counter Value: $counter";
} else {
    $message .= " | No counter found in session.";
}

header("Location: index.php?message=$message");
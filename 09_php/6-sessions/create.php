<?php

session_start();

$_SESSION['counter'] = 1;
$message = "Session created. Counter initialized to 1.";
header("Location: index.php?message=$message");
<?php

$name = "counter";
$expire = 0;

setcookie($name, "", $expire);
header("Location: index.php?message=Cookie deleted successfully");

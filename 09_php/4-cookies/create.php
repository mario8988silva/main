<?php

$name = "counter";
$value = "1";
$expire = time() + 3600; // +1h

setcookie($name, $value, $expire);
header("Location: index.php?message=Cookie created successfully");

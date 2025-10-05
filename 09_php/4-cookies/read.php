<?php

if (count($_COOKIE) > 0) {
    echo "<pre>";
    print_r($_COOKIE);
    echo "</pre>";
} else {
    header("Location: index.php?message=Cookie monster ate all cookies!");
}

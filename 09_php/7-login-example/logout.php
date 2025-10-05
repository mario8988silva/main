<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// 23. Starts session and removes authentication flag
unset($_SESSION['authenticated']);

// 24. Redirects to login with logout message
header('Location: index.php?message=You have been logged out successfully.');
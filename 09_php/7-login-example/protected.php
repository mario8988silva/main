<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    // 14. Starts session to access session variables
    session_start();
}

// 15. If user is not authenticated:
if (!isset($_SESSION['authenticated'])) {
    // 16. Sends 403 Forbidden
    http_response_code(403);

    // 17. Redirects to login with error message
    header('Location: index.php?message=Access denied. Please log in first.');
    exit();
}

// 18. Loads the protected page view
include 'views/protected.view.phtml';
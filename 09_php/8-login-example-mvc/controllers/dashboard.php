<?php
require_once '../services/authentication.php';
// 10. If login succeeds:
$user = isAuthenticated();

// 11. dashboard.view.phtml
include '../views/dashboard.view.phtml';
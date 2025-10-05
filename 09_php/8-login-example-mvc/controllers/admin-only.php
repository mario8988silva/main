<?php

require_once '../services/authentication.php';
require_once '../core/http.php';

// 16. controllers/admin-only.php runs:
if (!isAdmin()) {
    http_response_code(403);
    redirect('/dashboard?message=Access denied. Admins only.');
}

include '../views/admin-only.view.phtml';
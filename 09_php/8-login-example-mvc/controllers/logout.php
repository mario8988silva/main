<?php
// 18. controllers/logout.php runs:
require_once '../services/authentication.php';
require_once '../core/http.php';

logout();
redirect('/');
<?php
// 1. User visits a URL (e.g. /login)
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$routes = [
    '/' => 'home',
    '/login' => 'login',
    '/register' => 'register',
    '/logout' => 'logout',
    '/dashboard' => 'dashboard',
    '/admin-only' => 'admin-only',
    '/export' => 'export',
];

// 2.public/index.php runs:
$route = $_SERVER['PATH_INFO'] ?? '/';

if (!array_key_exists($route, $routes)) {
    http_response_code(404);
    echo "404 Not Found";
    exit();
}

$controller = $routes[$route];
// 2.2 public/index.php runs:
require_once "../controllers/{$controller}.php";

// 3. It maps /login to controllers/login.php

/* ----------------------------------------------
Overall Architecture:

public/index.php                ← Entry point & router
controllers/                    ← Logic for each route
views/                          ← HTML templates
services/authentication.php     ← Login/session logic
core/http.php                   ← Utility for redirects

------------------------------------------------

File Relationships
Layer	        Role	                                    Key Files

Routing	        Maps URL paths to controllers	            public/index.php
Controllers	    Handle logic for each route	                controllers/*.php
Services	    Reusable backend logic (auth, session)	    services/authentication.php
Views	        HTML templates for UI	                    views/*.view.phtml
Core	        Utility functions	                        core/http.php


------------------------------------------------

*/
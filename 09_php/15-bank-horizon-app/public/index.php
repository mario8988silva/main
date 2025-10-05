<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$routes = [
    '/login'            => 'auth/login',
    '/register'         => 'auth/register',
    '/logout'           => 'auth/logout',

    '/dashboard'        => 'bank/dashboard',
    '/accounts/create'   => 'bank/accounts/create',
    '/accounts/deposit'  => 'bank/accounts/deposit',
    '/accounts/withdraw' => 'bank/accounts/withdraw',
    '/accounts/transfer' => 'bank/accounts/transfer',
    '/accounts/history'  => 'bank/accounts/history',
];

$route = $_SERVER['PATH_INFO'] ?? '/dashboard';

if (!array_key_exists($route, $routes)) {
    http_response_code(404);
    echo "404 Not Found";
    exit();
}

$controller = $routes[$route];
$file = "../src/controllers/{$controller}.php";

if (!file_exists($file)) {
    http_response_code(500);
    echo "500 Internal Server Error: Controller file not found.";
    exit();
}

require_once $file;
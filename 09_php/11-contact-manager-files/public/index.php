<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$routes = [
    '/'                 => 'auth/login',
    '/login'            => 'auth/login',
    '/register'         => 'auth/register',
    '/logout'           => 'auth/logout',

    '/contacts/list'    => 'contacts/list',
    '/contacts/detail'  => 'contacts/detail',
    '/contacts/create'  => 'contacts/create',
    '/contacts/edit'    => 'contacts/edit',
    '/contacts/delete'  => 'contacts/delete',

    '/contacts/export'  => 'contacts/export',

    '/api/contacts'     => 'contacts/api/list',
];

$route = $_SERVER['PATH_INFO'] ?? '/';

if (!array_key_exists($route, $routes)) {
    http_response_code(404);
    echo "404 Not Found";
    exit();
}

$controller = $routes[$route];
$file = "../controllers/{$controller}.php";

if (!file_exists($file)) {
    http_response_code(500);
    echo "500 Internal Server Error: Controller file not found.";
    exit();
}

require_once "../controllers/{$controller}.php";
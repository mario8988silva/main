<?php
    
require_once '../core/http.php';

$users = [
    [
        'username' => 'francisco',
        'password' => password_hash('123456', PASSWORD_BCRYPT),
        'name' => 'Francisco',
        'roles' => ['ADMIN']
    ],
    [
        'username' => 'matateu',
        'password' => password_hash('123456', PASSWORD_BCRYPT),
        'name' => 'Matateu',
        'roles' => ['USER']
    ],
    [
        'username' => 'maria',
        'password' => password_hash('password', PASSWORD_BCRYPT),
        'name' => 'Maria',
        'roles' => ['ADMIN', 'USER']
    ]
];

function attemptLogin(string $username, string $password): bool {
    global $users;
    $filteredUsers = array_filter($users, fn($u) => $u['username'] === trim($username));
    $user = array_shift($filteredUsers);

    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user['password'])) {
        return false;
    }

    $_SESSION['user'] = $user;
    return true;
}

function isAuthenticated(): array {
    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        redirect('/login?message=You must be logged in to access this page.');
        exit();
    }

    return $_SESSION['user'];
}

function logout(): void {
    unset($_SESSION['user']);
}

function blockUser(string $ip) {
    $blacklist = ['10.120.60.166'];

    if (in_array($ip, $blacklist)) {
        http_response_code(418);
        $error = 'I\'m a teapot. You cannot access this page.';
        die($error);
        exit();
    }
}

function isAdmin() {
    $user = isAuthenticated();
    return in_array('ADMIN', $user['roles']);
}
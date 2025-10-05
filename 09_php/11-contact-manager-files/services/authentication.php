<?php
    
require_once '../core/http.php';

function findUsers() {
    $files = glob('../data/users/*');
    return array_map(fn($file) => unserialize(file_get_contents($file)), $files);
}

function findUserByUsername(string $username) {
    $user = findUsers();
    return current(array_filter($user, fn($u) => $u['username'] === $username));
}

function attemptLogin(string $username, string $password): bool {
    $user = findUserByUsername($username);

    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user['password'])) {
        return false;
    }

    $_SESSION['user'] = $user;
    return true;
}

function createUser(string $username, string $password, string $name) {
    $id = uniqid();
    $user = [
        'id' => $id,
        'username' => $username,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'name' => $name,
        'createdAt' => time(),
        'roles' => ['USER']
    ];

    file_put_contents("../data/users/$id", serialize($user));
}

function isAuthenticated(): array {
    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        redirect('/login?message=You must be logged in to access this page.');
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
<?php
    
require_once '../src/core/http.php';
require_once '../src/core/database.php';

function findUserByUsername(string $username) {
    $connection = getConnection();
    $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";

    $stmt = $connection->prepare($sql);
    // $stmt->bindParam('username', $username);
    $stmt->execute(['username' => $username]);

    return $stmt->fetch();
}

function attemptLogin(string $username, string $password): bool {
    $user = findUserByUsername($username);

    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user->password)) {
        return false;
    }

    $_SESSION['user'] = $user;
    return true;
}

function createUser(string $username, string $password, string $name, string $email = '') {
    $connection = getConnection();
    $sql = "INSERT INTO users (username, password, name, email) VALUES (:username, :password, :name, :email)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'name' => $name,
        'email' => "$username@example.com"
    ]);

    return $connection->lastInsertId();
}

function isAuthenticated() {
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
    return $user->role === 'admin';
}
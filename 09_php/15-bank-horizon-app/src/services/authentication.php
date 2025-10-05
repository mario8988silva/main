<?php
    
require_once '../src/models/User.php';
require_once '../src/core/http.php';
require_once '../src/core/database.php';
require_once '../src/services/accounts.php';

function findUserByEmail(string $email) {
    $connection = getConnection();
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";

    $stmt = $connection->prepare($sql);
    $stmt->execute(['email' => $email]);

    $row = $stmt->fetch();

    if (!$row) {
        return null;
    }

    return new User($row->id, $row->name, $row->email, $row->password, $row->created_at);
}

function attemptLogin(string $email, string $password): bool {
    $user = findUserByEmail($email);

    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user->getPasswordHash())) {
        return false;
    }

    $_SESSION['user'] = serialize($user);
    return true;
}

function createUser(string $email, string $password, string $name) {
    $connection = getConnection();
    $sql = "INSERT INTO users (email, password, name) VALUES (:email, :password, :name)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'name' => $name
    ]);

    $userId = $connection->lastInsertId();

    createAccount($userId, 'Conta corrente', 'Conta corrente por defeito');

    return $userId;
}

function isAuthenticated() {
    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        redirect('/login?message=You must be logged in to access this page.');
    }

    //TODO: check if user has account and redirect to create account page if not
    
    return unserialize($_SESSION['user']);
}

function logout(): void {
    unset($_SESSION['user']);
}
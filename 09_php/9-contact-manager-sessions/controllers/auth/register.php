<?php

require_once '../services/authentication.php';
require_once '../core/http.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';

    if (empty($username) || empty($password) || empty($name)) {
        http_response_code(400);
        redirect('/register?message=All fields are required.');
        exit();
    }

    createUser($username, $password, $name);
    redirect('/login?message=Registration successful. Please log in.');
}

include '../views/auth/register.view.phtml';
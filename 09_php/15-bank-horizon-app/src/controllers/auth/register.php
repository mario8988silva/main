<?php

require_once '../src/services/authentication.php';
require_once '../src/core/http.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordConfirmation = $_POST['password_confirmation'] ?? '';
    $termsAccepted = isset($_POST['terms']);

    if (empty($email) || empty($password) || empty($firstName) || empty($lastName)) {
        http_response_code(400);
        redirect('/register?message=All fields are required.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        redirect('/register?message=Invalid email format.');
    }

    if (strlen($password) < 8) {
        http_response_code(400);
        redirect('/register?message=Password must be at least 8 characters long.');
    }

    if ($password !== $passwordConfirmation) {
        http_response_code(400);
        redirect('/register?message=Passwords do not match.');
    }

    if (!$termsAccepted) {
        http_response_code(400);
        redirect('/register?message=You must accept the terms and conditions.');
    }

    $name = trim($firstName . ' ' . $lastName);

    createUser($email, $password, $name);
    
    redirect('/login?message=Registration successful. Please log in.');
}

render(
    'auth/register', 
    layout: false
);
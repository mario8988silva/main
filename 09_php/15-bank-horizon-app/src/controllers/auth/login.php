<?php

require_once '../src/services/authentication.php';
require_once '../src/core/http.php';

$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (attemptLogin($email, $password)) {
        redirect('/dashboard');
    }

    $messages[] = [
        'type' => 'danger',
        'message' => 'Invalid credentials.'
    ];
}

if (isset($_GET['message'])) {
    $messages[] = [
        'type' => 'info',
        'message' => $_GET['message']
    ];
}

render('auth/login', ['messages' => $messages], false);
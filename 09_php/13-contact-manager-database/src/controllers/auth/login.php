<?php

require_once '../src/services/authentication.php';
require_once '../src/core/http.php';

$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (attemptLogin($username, $password)) {
        redirect('/contacts/list');
    }

    $messages[] = [
        'type' => 'danger',
        'message' => 'Invalid username or password.'
    ];
}

if (isset($_GET['message'])) {
    $messages[] = [
        'type' => 'info',
        'message' => $_GET['message']
    ];
}

render('auth/login', ['messages' => $messages], false);
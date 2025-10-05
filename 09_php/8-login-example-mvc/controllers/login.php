<?php

require_once '../services/authentication.php';
require_once '../core/http.php';

/* 5. Form sends POST to /login
      controllers/login.php runs:
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 6. Calls attemptLogin() from services/authentication.php
    /* 7. Authentication Logic
            attemptLogin():
                Finds user by username
                Verifies password with password_verify()
                If valid, stores user in $_SESSION['user']
    */
    if (attemptLogin($username, $password)) {
        // 8. Redirect to Dashboard: If login succeeds:
        redirect('/dashboard');

        // 9.controllers/dashboard.php
    }

    $error = 'Invalid username or password.';
}

$error = $error ?? $_GET['message'] ?? null;

// 4. Shows the login form from login.view.phtml
include '../views/login.view.phtml';
<?php
// 1.Login Controller

// 2.Hardcoded credentials for demo purposes
const VALID_USERNAME = 'zacarias';
const VALID_PASSWORD = '123456';

// 3.Checks if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //4. Retrieves submitted credentials
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* 5.If credentials match:
            Starts session
            Sets authenticated flag
            Redirects to protected page
    */
    if ($username === VALID_USERNAME && $password === VALID_PASSWORD) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['authenticated'] = true;
        header('Location: protected.php');
        exit();
    } 

    // 6.If login fails, sets error message
    $error = 'Invalid username or password.';
}

// 7.Also checks for messages passed via URL (e.g. after logout)
$error = $error ?? $_GET['message'] ?? null;

// 8.Easter egg: blocks a specific IP with HTTP 418 (I'm a teapot ☕)
if ($_SERVER['REMOTE_ADDR'] === '10.120.60.166') {
    http_response_code(418);
    $error = 'I\'m a teapot. You cannot access this page.';
    die($error);
    exit();
}

// 9. Loads the login form view
include 'views/login.view.phtml';

// 10. login.view.phtml — Login Form UI

/*
Overall Flow
    User visits index.php → sees login form
    User submits credentials → PHP checks them
    If valid, session is started → user redirected to protected.php
    If invalid, error message shown
    protected.php checks session → if not authenticated, redirects back
    User clicks logout → session is cleared, redirected to login


How It All Connects  
    Step	File	                Action
    1	    index.php	            Shows login form
    2	    login.view.phtml	    User submits credentials
    3	    index.php	            Validates and sets session
    4	    protected.php	        Checks session, shows protected content
    5	    protected.view.phtml	Displays secured page
    6	    logout.php	            Clears session, redirects to login


*/
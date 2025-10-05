<?php

require_once __DIR__ . '/../../../services/authentication.php';
require_once __DIR__ . '/../../../services/accounts.php';
require_once __DIR__ . '/../../../core/http.php';

$user = isAuthenticated();

if (isPost()) {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    createAccount($user->getId(), $name, $description);
    redirect('/dashboard');
}

render('bank/accounts/create', [
    'user' => $user,
]);
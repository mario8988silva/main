<?php

require_once __DIR__ . '/../../../services/authentication.php';
require_once __DIR__ . '/../../../services/accounts.php';
require_once __DIR__ . '/../../../services/transactions.php';
require_once __DIR__ . '/../../../core/http.php';

$user = isAuthenticated();

if (!isPost()) {
    http_response_code(405);
    exit('Method Not Allowed');
}

$origin = $_POST['origin'] ?? '';
$amount = floatval($_POST['amount'] ?? 0);
$note = $_POST['note'] ?? '';

$account = getAccount($origin);
$account->withdraw($amount);

updateAccount($account);
recordTransaction($account->accountNumber(), 'withdrawal', -$amount, $note);

redirect('/dashboard');
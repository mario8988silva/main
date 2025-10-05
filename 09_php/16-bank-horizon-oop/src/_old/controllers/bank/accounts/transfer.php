<?php

require_once __DIR__ . '/../../../services/authentication.php';
require_once __DIR__ . '/../../../services/accounts.php';
require_once __DIR__ . '/../../../services/transactions.php';
require_once __DIR__ . '/../../../core/http.php';

$user = isAuthenticated();

if (isPost()) {
    $origin = $_POST['origin'] ?? '';
    $target = $_POST['target'] ?? '';
    $amount = floatval($_POST['amount'] ?? 0);
    $beneficiary = $_POST['beneficiary'] ?? '';
    $reference = $_POST['reference'] ?? '';
    $message = $_POST['message'] ?? '';
    $remember = $_POST['remember'] ?? false;

    $originAccount = getAccount($origin);
    $targetAccount = getAccount($target);

    $originAccount->transfer($amount, $targetAccount);

    updateAccount($originAccount);
    updateAccount($targetAccount);

    recordTransaction($originAccount->accountNumber(), 'transfer', -$amount, $reference, $targetAccount->accountNumber());
    recordTransaction($targetAccount->accountNumber(), 'transfer', $amount, $message, $originAccount->accountNumber());
    
    redirect('/dashboard');
}

$accounts = getUserAccounts($user->getId());

render('bank/accounts/transfer', [
    'user' => $user,
    'accounts' => $accounts,
]);
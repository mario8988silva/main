<?php

require_once __DIR__ . '/../../services/authentication.php';
require_once __DIR__ . '/../../services/accounts.php';
require_once __DIR__ . '/../../services/transactions.php';
require_once __DIR__ . '/../../core/http.php';

$user = isAuthenticated();

$accounts = getUserAccounts($user->getId());
$totalBalance = array_reduce($accounts, fn($sum, $account) => $sum + $account->balance(), 0.0);
$lastUpdatedAccount = array_reduce($accounts, fn($a, $b) => $a?->updatedAt() > $b?->updatedAt() ? $a : $b);

$transactions = getTransactionsByUserId($user->getId());

render('bank/dashboard', [
    'user' => $user,
    'accounts' => $accounts,
    'totalBalance' => $totalBalance,
    'lastUpdatedAccount' => $lastUpdatedAccount,
    'transactions' => $transactions,
]);
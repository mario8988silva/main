<?php

require_once '../src/core/database.php';

function getTransactionsByUserId(string $userId) {
    $connection = getConnection();

    $sql = "SELECT 
                t.*, 
                a.name AS account_origin
            FROM transactions t
            JOIN accounts a ON t.account_number = a.account_number
            JOIN user_accounts ua ON a.account_number = ua.account_number
            WHERE ua.user_id = :user_id
            ORDER BY t.created_at DESC";
    
    $stmt = $connection->prepare($sql);
    $stmt->execute([':user_id' => $userId]);

    return $stmt->fetchAll();
}

function recordTransaction(string $accountId, string $type, float $amount, string $description = '', string $target = '') {
    
    $connection = getConnection();

    $sql = "INSERT INTO transactions (
                account_number, type, amount, description, target) 
            VALUES (
                :account_number, :type, :amount, :description, :target
            )";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':account_number' => $accountId,
        ':type' => $type,
        ':amount' => $amount,
        ':description' => $description,
        ':target' => $target
    ]);
    return $connection->lastInsertId();
}
<?php
require_once '../src/_old/core/database.php';
require_once '../src/_old/models/BankAccount.php';

function uuidv4() {
  $data = random_bytes(16);

  $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    
  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function getUserAccounts(int $userId) {
    $db = getConnection();
    $sql = "SELECT a.*
            FROM accounts a
            JOIN user_accounts ua ON a.account_number = ua.account_number
            WHERE ua.user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    $rows = $stmt->fetchAll();

    $accounts = [];

    foreach ($rows as $row) {
        $accounts[] = new BankAccount(
            $row->name,
            $row->description,
            $row->status,
            $row->account_number,
            $row->balance,
            $row->created_at,
            $row->updated_at
        );
    }

    return $accounts;
}

function getAccount(string $accountNumber) {
    $connection = getConnection();
    $sql = "SELECT * FROM accounts WHERE account_number = :accountNumber";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'accountNumber' => $accountNumber
    ]);

    $row = $stmt->fetch();

    return new BankAccount(
        $row->name,
        $row->description,
        $row->status,
        $row->account_number,
        $row->balance,
        $row->created_at,
        $row->updated_at
    );
}

function createAccount(int $userId, string $name, string $description) {
    $db = getConnection();
    $accountNumber = uuidv4();
    $sql = "INSERT INTO accounts (account_number, name, description) VALUES (:account_number, :name, :description)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'account_number' => $accountNumber,
        'name' => $name, 
        'description' => $description
    ]);

    $sql = "INSERT INTO user_accounts (user_id, account_number) VALUES (:user_id, :account_number)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'user_id' => $userId,
        'account_number' => $accountNumber
    ]);
}

function updateAccount(BankAccount $account) {
    $db = getConnection();
    $sql = "UPDATE accounts SET name = :name, description = :description, status = :status, balance = :balance WHERE account_number = :account_number";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'name' => $account->name(),
        'description' => $account->description(),
        'status' => $account->status(),
        'balance' => $account->balance(),
        'account_number' => $account->accountNumber()
    ]);
}
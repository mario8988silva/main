<?php namespace App\Service;

use App\Model\BankAccount;
use Core\Database\Connection;
use Core\Utils\UUID;

class BankAccountService {

    public function findByUserId(int $userId, int $limit = 10, int $offset = 0): array {
        $db = Connection::get();
        $sql = "SELECT a.*
                FROM accounts a
                JOIN user_accounts ua ON a.account_number = ua.account_number
                WHERE ua.user_id = :user_id
                LIMIT $offset, $limit";
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

    public function findByAccountNumber(string $accountNumber) {
        $connection = Connection::get();
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

    public function create(int $userId, string $name, string $description) {
        $db = Connection::get();
        $accountNumber = UUID::random();
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

    public function update(BankAccount $account) {
        $db = Connection::get();
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

    public function getUserBalance(int $userId): float {
        $db = Connection::get();
        $sql = "SELECT SUM(a.balance) as total_balance
                FROM accounts a
                JOIN user_accounts ua ON a.account_number = ua.account_number
                WHERE ua.user_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $row = $stmt->fetch();

        return $row ? (float)$row->total_balance : 0.0;
    }

    public function getUserLastUpdated(int $user) {
        $db = Connection::get();
        $sql = "SELECT a.*
                FROM accounts a
                JOIN user_accounts ua ON a.account_number = ua.account_number
                WHERE ua.user_id = :user_id
                ORDER BY a.updated_at DESC
                LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute(['user_id' => $user]);
        $row = $stmt->fetch();

        if ($row) {
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

        return null;
    }
}
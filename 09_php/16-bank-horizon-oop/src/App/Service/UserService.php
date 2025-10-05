<?php namespace App\Service;

use Core\Database\Connection;
use App\Model\User;

class UserService {

    private readonly BankAccountService $bankAccountService;

    public function __construct(BankAccountService $bankAccountService) {
        $this->bankAccountService = $bankAccountService;
    }

    public function findByEmail(string $email) {
        $connection = Connection::get();
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $stmt = $connection->prepare($sql);
        $stmt->execute(['email' => $email]);

        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new User($row->id, $row->name, $row->email, $row->password, $row->created_at);
    }

    public function create(string $email, string $password, string $name) {
        $connection = Connection::get();
        $sql = "INSERT INTO users (email, password, name) VALUES (:email, :password, :name)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'name' => $name
        ]);

        $userId = $connection->lastInsertId();

        $this->bankAccountService->create($userId, 'Conta corrente', 'Conta corrente por defeito');

        return $userId;
    }

    public function save(User $user) {
        $connection = Connection::get();
        $data = [
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'password' => $user->getPasswordHash(),
            'id' => $user->getId()
        ];

        if (!$user->getId()) {
            $sql = "INSERT INTO users (email, name, password) VALUES (:email, :name, :password)";
            unset($data['id']);
        } else {
            $sql = "UPDATE users SET email = :email, name = :name, password = :password WHERE id = :id";
        }
        
        $stmt = $connection->prepare($sql);
        $stmt->execute($data);
    }
}
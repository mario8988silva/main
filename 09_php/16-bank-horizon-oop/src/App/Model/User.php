<?php namespace App\Model;

use Core\Validation\Validate;
use DateTime;
use Exception;

class User {

    private ?int $id;
    private string $name;
    private string $email;
    private string $passwordHash;
    private DateTime $createdAt;

    public function __construct(?int $id, string $name, string $email, string $password, string $createdAt) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = $password;
        $this->createdAt = new DateTime($createdAt);
    }

    public static function create(string $firstName, string $lastName, string $email, string $password, $passwordConfirmation) {
        if (!Validate::emptyFields([$firstName, $lastName, $email, $password, $passwordConfirmation])) {
            throw new Exception('All fields are required.');
        }

        if (!Validate::email($email)) {
            throw new Exception('Invalid email format.');
        }

        if (!Validate::password($password, 8)) {
            throw new Exception('Password must be at least 8 characters long.');
        }

        if (!Validate::matches($password, $passwordConfirmation)) {
            throw new Exception('Passwords do not match.');
        }
        
        $name = trim($firstName . ' ' . $lastName);
        $user = new User(null, $name, $email, password_hash($password, PASSWORD_DEFAULT), date('Y-m-d H:i:s'));

        return $user;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getFirstName() {
        return explode(' ', $this->name)[0];
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPasswordHash(): string {
        return $this->passwordHash;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }
}
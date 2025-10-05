<?php 

class User {

    private int $id;
    private string $name;
    private string $email;
    private string $passwordHash;
    private DateTime $createdAt;

    public function __construct(int $id, string $name, string $email, string $passwordHash, string $createdAt) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->createdAt = new DateTime($createdAt);
    }

    public function getId(): int {
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
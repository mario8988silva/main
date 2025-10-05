<?php

class BankAccount {

    private string $name;
    private string $description;
    private string $status;
    private string $accountNumber;
    private float $balance;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(string $name, string $description, string $status, string $accountNumber, float $balance, string $createdAt, string $updatedAt) {
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->accountNumber = $accountNumber;
        $this->balance = $balance;
        $this->createdAt = new DateTime($createdAt);
        $this->updatedAt = new DateTime($updatedAt);
    }

    public function name(): string {
        return $this->name;
    }

    public function description(): string {
        return $this->description;
    }

    public function status(): string {
        return $this->status;
    }

    public function createdAt(): DateTime {
        return $this->createdAt;
    }
    
    public function updatedAt(): DateTime {
        return $this->updatedAt;
    }

    public function accountNumber(bool $hidden = false): string {
        return $hidden ? '****' . substr($this->accountNumber, -4) : $this->accountNumber;
    }

    public function balance(): float {
        return $this->balance;
    }

    public function deposit(float $amount) {
        if ($amount <= 0) {
            throw new Exception('Deposit amount must be positive.');
        }
        
        $this->balance += $amount;
    }

    public function withdraw(float $amount) {
        if ($amount <= 0) {
            throw new Exception('Withdrawal amount must be positive.');
        }

        if ($amount > $this->balance) {
            throw new Exception("Insufficient funds for this withdrawal. ({$this->balance} available)");
        }

        $this->balance -= $amount;
    }

    public function transfer(float $amount, BankAccount $account) {
        if ($this->accountNumber() === $account->accountNumber()) {
            throw new Exception('Cannot transfer to the same account.');
        }

        $this->withdraw($amount);
        $account->deposit($amount);
    }
}
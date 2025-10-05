<?php

/**
 * 3 pilares:
 * - Encapsulamento
 * - Herança
 * - Polimorfismo
 */

// class Person {
//     public string $name;

//     public function __construct(string $name = '') {
//         echo "Person class instantiated\n";
//         $this->name = $name;
//     }

//     public function greet(): void {
//         echo "Hello, my name is {$this->name}";
//     }
// }

// $instance1 = new Person();
// $instance1->name = 'John Doe';
// $instance1->greet();

// $instance2 = new Person();
// $instance2->name = 'Jane Doe';
// $instance2->greet();

// $instance3 = new Person('Alice');
// $instance3->greet();

class BankAccount {

    private string $accountNumber;
    private float $balance;

    public function __construct(?string $accountNumber = null, float $initialBalance = 0.0) {
        $this->accountNumber = $accountNumber ?? uniqid();
        $this->balance = $initialBalance;
    }

    public function accountNumber(): string {
        return $this->accountNumber;
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

$account1 = new BankAccount('123456');
// $account1->accountNumber = '123456';

$account1->deposit(500);
$account1->withdraw(200);
$account1->deposit(1500);
// $account1->withdraw(5000);

$account2 = new BankAccount();

$account1->transfer(300, $account2);

echo $account1->balance() . "\n";
echo $account2->balance() . "\n";
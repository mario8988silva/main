<pre>
<?php

class Paciente {
    public int $id;
    public string $nome;
    public string $data_nascimento;
    public string $genero;
    public string $telefone;
    public string $email;
    public string $data_registo;

    public function idade(): int {
        $birthDate = new DateTime($this->data_nascimento);
        $today = new DateTime();
        $diff = $today->diff($birthDate);

        return $diff->y;
    }
}

// $p1 = new Paciente();
// $p1->data_nascimento = '2000-10-01';
// echo $p1->idade();

// $p2 = new Paciente();
// $p2->data_nascimento = '1990-05-15';
// echo $p2->idade();
// die();

/**
 * mysql_*  -> functions are deprecated in PHP 5.5.0 and removed in PHP 7.0.0.
 * MySQLi   -> mysqli_* functions or MySQLi class. Only works with MySQL.
 * PDO      -> PHP Data Objects, works with multiple databases (MySQL, PostgreSQL, SQLite, etc.)
 */

// connect to the database
// $host = '127.0.0.1';
// $port = 3306;
// $username = 'root';
// $password = 'docker';
// $database = 'hospital';

$config = require 'config.php';
extract($config);

try {
    $connection = new PDO($dsn, $username, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

$sql = "SELECT * FROM pacientes";
$stmt = $connection->query($sql);
// print_r($stmt);
// $row = $stmt->fetch();
// print_r($row);
// $row = $stmt->fetch();
// print_r($row);

// while ($row = $stmt->fetch()) {
//     print_r($row);
// }
// $patients = $stmt->fetchAll();
// print_r($patients);

// $patients = $stmt->fetchAll(PDO::FETCH_CLASS, Paciente::class);
// print_r($patients);
// echo $patients[0]->idade();

// $sql = "INSERT INTO pacientes (nome, data_nascimento, genero, telefone, email, data_registo)
//         VALUES ('Matateu Silva', '1980-01-15', 'M', '912345678', 'matateu@example.com', NOW())";

// $sql = "DELETE FROM pacientes WHERE id = 161";
// $stmt = $connection->query($sql);

// echo "New record created successfully. Last inserted ID is: " . $connection->lastInsertId();
// echo "Rows affected: " . $stmt->rowCount();

$migration = "CREATE DATABASE IF NOT EXISTS contacts;";
$migration .= "USE contacts;";
$migration .= "CREATE TABLE IF NOT EXISTS contacts (";
$migration .= " id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
$migration .= " name VARCHAR(100) NOT NULL, ";
$migration .= " email VARCHAR(100) NOT NULL, ";
$migration .= " phone VARCHAR(15) NOT NULL, ";
$migration .= " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
$migration .= ") ENGINE=InnoDB;";

$connection->exec($migration);
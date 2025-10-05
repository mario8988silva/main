<?php

$connection = null;

function getConnection(): PDO {
    global $connection;

    if (!is_null($connection)) {
        return $connection;
    }

    $config = require '../config/database.config.php';
    extract($config);

    try {
        $connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        return $connection;
    } catch (PDOException $e) {
        http_response_code(500);
        die("Database connection failed: " . $e->getMessage());
    }
}
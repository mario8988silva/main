<?php namespace Core\Database;

use Exception;
use PDO;
use PDOException;

class Connection {
    private static $connection = null;

    public static function get(): PDO {
        if (!is_null(self::$connection)) {
            return self::$connection;
        }

        $config = require '../config/database.config.php';
        extract($config);

        try {
            self::$connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
            return self::$connection;
        } catch (PDOException $e) {
            throw new Exception('Database connection error: ' . $e->getMessage(), 500);
        }
    }
}
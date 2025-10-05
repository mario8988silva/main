<?php

$migrations = glob(__DIR__ . '/migrations/*.sql');

if (count($migrations) === 0) {
    echo "No migrations found.\n";
    exit(0);
}

$config = require __DIR__ . '/../config/database.config.php';

try {
    $connection = new PDO($config['dsn'], $config['username'], $config['password']);

    if (file_exists(__DIR__ . '/migrations.json')) {
        $appliedMigrations = json_decode(file_get_contents(__DIR__ . '/migrations.json'), true);
    } else {
        $appliedMigrations = [];
    }
    
    foreach ($migrations as $migration) {
        $name = basename($migration);

        if (in_array($name, $appliedMigrations)) {
            echo "✅ Migration already applied: " . $name . "\n";
            continue;
        }

        $sql = file_get_contents($migration);
        $connection->exec($sql);
        echo "👩🏼‍💻 Applied migration: " . $name . "\n";

        $appliedMigrations[] = $name;
    }

    file_put_contents(__DIR__ . '/migrations.json', json_encode($appliedMigrations, JSON_PRETTY_PRINT) );
    echo "🐼 All migrations applied successfully.\n";
} catch (PDOException $e) {
    echo "⚠️ Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
}
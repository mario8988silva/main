<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$counter = $_SESSION['counter'] ?? 0;
$message = $_GET['message'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
  </head> 
  <body>
    <div class="container">
        <h1>😴 Welcome to Sessions Demo</h1>
  
        <?php if ($message) : ?>
            <div class="message">
                <?= $message ?>
            </div>
        <?php endif; ?>
  
        <h2>Your Session Counter: <?= $counter ?></h2>

        <ul>
            <li>
                <a href="create.php">Create Session</a>
            </li>
            <li>
                <a href="read.php">Read Session</a>
            </li>
            <li>
                <a href="update.php">Update Session</a>
            </li>
            <li>
                <a href="delete.php">Delete Session</a>
            </li>
        </ul>
    </div>
</body>
</html>
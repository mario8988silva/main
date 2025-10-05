<?php
$message = $_GET['message'] ?? null;
$counter = $_COOKIE['counter'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
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
        <h1>🍪 Welcome to Cookies Demo</h1>

        <?php if ($message) : ?>
            <div class="message">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <h2>Your Cookie Counter: <?= $counter ?></h2>

        <ul>
            <li>
                <a href="create.php">Create Cookie</a>
            </li>
            <li>
                <a href="read.php">Read Cookie</a>
            </li>
            <li>
                <a href="update.php">Update Cookie</a>
            </li>
            <li>
                <a href="delete.php">Delete Cookie</a>
            </li>
        </ul>
    </div>

    <script>
        console.log("Current Cookies:", document.cookie);
        const cookies = document.cookie
            .split('; ')
            .reduce((acc, cookie) => {
                const [name, value] = cookie.split('=');
                acc[name] = value;
                return acc;
            }, {});
        console.log("Parsed Cookies:", cookies);
    </script>
</body>

</html>
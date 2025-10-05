<?php
    function generateFileName(string $originalName) {
        $hash = uniqid();
        $path = 'images';
        $date = date('YmdHis');

        return "$path/$date-$hash-$originalName";
    }

    function createFile(string $name, string $tmpName) {
        $target = generateFileName($name);
        return move_uploaded_file($tmpName, $target);
    }

    function removeFile(string $name) {
        if (file_exists($name)) {
            unlink($name);
        }
    }

    function duplicateFile(string $name) {
        $target = generateFileName('duplicate');
        $data = file_get_contents($name);
        file_put_contents($target, $data);
        // return copy($name, $target);
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // die();

        if (createFile($_FILES['image']['name'], $_FILES['image']['tmp_name'])) {
            $message = 'File uploaded successfully';
        } else {
            $message = 'File upload failed';
        }
    }

    $action = $_GET['action'] ?? null;
    $name = $_GET['name'] ?? null;

    switch ($action) {
        case 'delete':
            removeFile($name);
            break;
        case 'duplicate':
            duplicateFile($name);
            break;
    }

    $images = glob('images/*');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            padding: 2rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;

            img {
                width: 100%;
                height: auto;
                border-radius: 0.5rem;
                box-shadow: 0 0 0.5rem rgba(0,0,0,0.1);
            }
        }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <?= $message ?? '' ?>
        <input type="file" name="image">
        <button type="submit">Upload</button>
    </form>

    <hr>  

    <div class="grid">
        <?php foreach ($images as $image) : ?>
            <div>
                <img src="<?= $image ?>" width="400">
                <br>
                <a href="?action=delete&name=<?= $image ?>" onclick="return confirm('Apagar este ficheiro?')">Apagar</a>
                <a href="?action=duplicate&name=<?= $image ?>" onclick="return confirm('Duplicar este ficheiro?')">Duplicar</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
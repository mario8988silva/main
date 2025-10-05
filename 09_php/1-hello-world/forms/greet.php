<?php

// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     // header('HTTP/1.1 405 Method Not Allowed');
//     // die('Method Not Allowed');
//     header('Location: index.php');
//     exit;
// }

// $name = $_POST['name'];
$name = $_GET['name'] ?? 'Anónimo';

include 'views/greet.phtml';

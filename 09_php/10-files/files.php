<?php

// file_put_contents('data.txt', 'Hello, World!');
// file_put_contents('data.txt', "Hello, World!\n", FILE_APPEND);

// $content = file_get_contents('data.txt');
// echo $content;

// $content = file_get_contents('bit-coin.png');
// $filename = 'images/' . uniqid() . '.png';
// file_put_contents($filename, $content);

// $images = glob('images/*.png');
// print_r($images);

// $texts = glob('data/*.txt');

// foreach ($texts as $text) {
//     echo "<h1>$text</h1>";
//     echo nl2br(file_get_contents($text));
// }

// foreach ($images as $image) {
//     echo "<img src='$image' style='width: 200px;'><br>";
// }

$ts = filemtime('data/text-1.txt');
// echo date('Y-m-d H:i:s', $ts);
// $date = new DateTime();
// $date->setTimestamp($ts);
// echo $date->format('Y-m-d H:i:s');

// print_r(pathinfo('/foo/bar/baz.txt'));

// $rows = file('data/text-1.txt');
// print_r($rows);

// if (file_exists('new-image.png')) {
//     unlink('new-image.png');
// } else {
//     echo 'File does not exist';
//     file_put_contents('new-image.png', file_get_contents('bit-coin.png'));
// }
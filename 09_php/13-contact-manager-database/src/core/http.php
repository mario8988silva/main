<?php

function redirect(string $url): void {
    header("Location: $url");
    exit();
}

function render(string $view, array $data = [], bool $layout = true): void {
    $path = "../src/views/$view.view.phtml";

    if (!file_exists($path)) {
        http_response_code(500);
        echo "View not found: $view";
        exit();
    }

    extract($data);

    if ($layout) {
        render('layout/header', $data, false);
        include $path;
        render('layout/footer', $data, false);
    } else {
        include $path;
    }
}

function isPost() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
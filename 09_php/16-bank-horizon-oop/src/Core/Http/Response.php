<?php namespace Core\Http;

use Exception;

class Response {

    public static function redirect(string $url): void {
        header("Location: $url");
        exit();
    }

    public static function render(string $view, array $data = [], bool $layout = true): void {
        $path = "../views/$view.view.phtml";

        if (!file_exists($path)) {
            throw new Exception("View not found: $view", 500);
        }

        extract($data);

        if ($layout) {
            self::render('layout/header', $data, false);
            include $path;
            self::render('layout/footer', $data, false);
        } else {
            include $path;
        }
    }

    public static function json(array $data, int $status = 200): void {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit();
    }
}
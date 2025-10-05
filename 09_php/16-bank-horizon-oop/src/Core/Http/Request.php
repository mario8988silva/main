<?php namespace Core\Http;

class Request {

    public static function isPost(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function get(string $key, $default = null) {
        return $_GET[$key] ?? $default;
    }
    
    public static function post(string $key, $default = null) {
        return $_POST[$key] ?? $default;
    }
}
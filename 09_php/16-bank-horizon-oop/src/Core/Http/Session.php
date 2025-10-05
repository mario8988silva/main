<?php namespace Core\Http;

class Session {

    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy(): void {
        if (session_status() !== PHP_SESSION_NONE) {
            session_destroy();
        }
    }

    public static function get(string $key, $default = null) {
        self::start();

        if (!isset($_SESSION[$key])) {
            return $default;
        }
        
        return unserialize($_SESSION[$key]);
    }
    
    public static function set(string $key, $value): void {
        self::start();
        $_SESSION[$key] = serialize($value);
    }

    public static function remove(string $key): void {
        self::start();
        unset($_SESSION[$key]);
    }
}
<?php namespace Core\Validation;

class Validate {

    public static function emptyFields(array $fields): bool {
        foreach ($fields as $field) {
            if (self::empty($field)) {
                return true;
            }
        }
        return false;
    }

    public static function email(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function password(string $password, int $min = 6): bool {
        return strlen($password) >= $min;
    }

    public static function empty(string $name): bool {
        return strlen($name) === 0;
    }

    public static function matches(string $a, string $b): bool {
        return $a === $b;
    }

    public static function isTrue(bool $value): bool {
        return $value === true;
    }
}
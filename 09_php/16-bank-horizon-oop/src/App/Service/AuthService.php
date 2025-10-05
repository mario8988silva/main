<?php namespace App\Service;

use Core\Http\Session;
use Exception;

class AuthService {

    private readonly UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function attemptLogin(string $email, string $password) {
        $user = $this->userService->findByEmail($email);

        if (!$user) {
            throw new Exception('User not found', 404);
        }

        if (!password_verify($password, $user->getPasswordHash())) {
            throw new Exception('Invalid credentials', 401);
        }

        Session::set('user', $user);
    }   

    public function user() {
        return Session::get('user', null);
    }

    public function logout(): void {
        Session::remove('user');
    }
}
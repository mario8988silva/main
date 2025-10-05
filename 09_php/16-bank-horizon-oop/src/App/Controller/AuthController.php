<?php namespace App\Controller;

use App\Model\User;
use App\Service\AuthService;
use App\Service\BankAccountService;
use App\Service\UserService;
use Core\Http\Request;
use Core\Http\Response;
use Core\Mvc\Controller;
use Core\Validation\Validate;
use Exception;

class AuthController extends Controller {

    private readonly AuthService $authService;
    private readonly UserService $userService;

    public function __construct() {
        $bankAccountService = new BankAccountService();
        $this->userService = new UserService($bankAccountService);
        $this->authService = new AuthService($this->userService);
    }

    public function login() {
        $messages = [];
        if (isset($_GET['message'])) {
            $messages[] = [
                'type' => 'info',
                'message' => $_GET['message']
            ];
        }

        $this->render('auth/login', [
            'messages' => $messages
        ], false);
    }

    public function handleLogin() {
        $email = Request::post('email');
        $password = Request::post('password');

        try {
            $this->authService->attemptLogin($email, $password);
            $this->redirect('/dashboard');
        } catch (Exception $e) {
            $this->redirect('/login?message=Invalid+credentials.');
        }
    }

    public function register() {
        $this->render(
            'auth/register', 
            layout: false
        );
    }

    public function handleRegister() {
        $firstName = Request::post('first_name', '');
        $lastName = Request::post('last_name', '');
        $email = Request::post('email', '');
        $password = Request::post('password', '');
        $passwordConfirmation = Request::post('password_confirmation', '');
        $termsAccepted = Request::post('terms', false);

        if (!Validate::isTrue($termsAccepted)) {
            http_response_code(400);
            $this->redirect('/register?message=You+must+accept+the+terms+and+conditions.');
        }

        try {
            $user = User::create(
                $firstName,
                $lastName,
                $email,
                $password,
                $passwordConfirmation
            );
            
            $this->userService->save($user);
            $this->redirect('/login?message=Registration successful. Please log in.');
        } catch (Exception $e) {
            http_response_code(400);
            $this->redirect('/register?message=' . urlencode($e->getMessage()));
        }
    }

    public function logout() {
        $this->authService->logout();
        $this->redirect('/');
    }
}
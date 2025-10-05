<?php

use App\Controller\AccountsController;
use App\Controller\AuthController;
use App\Controller\DashboardController;
use Core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();

// Auth routes
$app->get('/login', [AuthController::class, 'login']);
$app->post('/login', [AuthController::class, 'handleLogin']);
$app->get('/register', [AuthController::class, 'register']);
$app->post('/register', [AuthController::class, 'handleRegister']);
$app->get('/logout', [AuthController::class, 'logout']);

// Bank routes
$app->get('/dashboard', [DashboardController::class, 'index']);

$app->get('/accounts', [AccountsController::class, 'index']);
$app->post('/accounts/create', [AccountsController::class, 'create']);
$app->post('/accounts/deposit', [AccountsController::class, 'deposit']);
$app->post('/accounts/withdraw', [AccountsController::class, 'withdraw']);
$app->post('/accounts/transfer', [AccountsController::class, 'transfer']);
$app->get('/accounts/:accountId', [AccountsController::class, 'show']);

$app->run('/dashboard');
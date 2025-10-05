<?php namespace App\Controller;

use App\Service\BankAccountService;
use App\Service\TransactionService;
use Core\Http\Response;
use Core\Mvc\SecuredController;

class DashboardController extends SecuredController {

    private readonly TransactionService $transactionService;
    private readonly BankAccountService $bankAccountService;

    public function __construct() {
        parent::__construct();
        $this->bankAccountService = new BankAccountService();
        $this->transactionService = new TransactionService();
    }

    public function index() {
        $accounts = $this->bankAccountService->findByUserId($this->user->getId(), 3);
        $totalBalance = $this->bankAccountService->getUserBalance($this->user->getId());
        $lastUpdatedAccount = $this->bankAccountService->getUserLastUpdated($this->user->getId());
        $transactions = $this->transactionService->findByUserId($this->user->getId());
        
        $this->render('bank/dashboard', [
            'user' => $this->user,
            'accounts' => $accounts,
            'totalBalance' => $totalBalance,
            'lastUpdatedAccount' => $lastUpdatedAccount,
            'transactions' => $transactions,
        ]);
    }
}
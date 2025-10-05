<?php namespace App\Controller;

use App\Service\BankAccountService;
use App\Service\TransactionService;
use Core\Http\Request;
use Core\Http\Response;
use Core\Mvc\SecuredController;

class AccountsController extends SecuredController {
    
    private readonly BankAccountService $bankAccountService;
    private readonly TransactionService $transactionService;

    public function __construct() {
        parent::__construct();
        $this->bankAccountService = new BankAccountService();
        $this->transactionService = new TransactionService();
    }
    
    public function index() {
        $page = Request::get('page', 0);
        $accounts = $this->bankAccountService->findByUserId($this->user->getId(), 5, $page * 5);
        
        $this->render('bank/accounts/index', [
            'accounts' => $accounts
        ]);
        // Response::json([
        //     'accounts' => $accounts
        // ]);
    }

    public function create() {
        $name = Request::post('name', '');
        $description = Request::post('description', '');

        $this->bankAccountService->create($this->user->getId(), $name, $description);
        $this->redirect('/dashboard');
    }

    public function deposit() {
        $target = Request::post('target', '');
        $amount = floatval(Request::post('amount', 0));
        $note = Request::post('note', '');

        $account = $this->bankAccountService->findByAccountNumber($target);
        $account->deposit($amount);

        $this->bankAccountService->update($account);
        $this->transactionService->create($account->accountNumber(), 'deposit', $amount, $note);

        $this->redirect('/dashboard');
    }

    public function withdraw() {
        $origin = Request::post('origin', '');
        $amount = floatval(Request::post('amount', 0));
        $note = Request::post('note', '');

        $account = $this->bankAccountService->findByAccountNumber   ($origin);
        $account->withdraw($amount);

        $this->bankAccountService->update($account);
        $this->transactionService->create($account->accountNumber(), 'withdrawal', -$amount, $note);

        $this->redirect('/dashboard');
    }

    public function transfer() {
        $origin = Request::post('origin', '');
        $target = Request::post('target', '');
        $amount = floatval(Request::post('amount', 0));
        $beneficiary = Request::post('beneficiary', '');
        $reference = Request::post('reference', '');
        $message = Request::post('message', '');
        $remember = Request::post('remember', false);

        $originAccount = $this->bankAccountService->findByAccountNumber($origin);
        $targetAccount = $this->bankAccountService->findByAccountNumber($target);

        $originAccount->transfer($amount, $targetAccount);

        $this->bankAccountService->update($originAccount);
        $this->bankAccountService->update($targetAccount);

        $this->transactionService->create($originAccount->accountNumber(), 'transfer', -$amount, $reference, $targetAccount->accountNumber());
        $this->transactionService->create($targetAccount->accountNumber(), 'transfer', $amount, $message, $originAccount->accountNumber());

        $this->redirect('/dashboard');
    }
}
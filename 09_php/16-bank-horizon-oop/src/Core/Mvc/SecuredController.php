<?php namespace Core\Mvc;

use App\Model\User;
use Core\Http\Session;

abstract class SecuredController extends Controller {
    
    protected User $user;

    public function __construct() {
        $authUser = Session::get('user', null);

        if (!$authUser) {
            $this->redirect('/login');
        }

        $this->user = $authUser;
    }
}
<?php

require_once '../services/authentication.php';
require_once '../services/contacts.php';

$user = isAuthenticated();

if (isPost()) {
    extract($_POST);
    extract($_FILES);

    $contact = createContact($name, $email, $phone, $photo);
    redirect('/contacts/list');
}

render('contacts/form');
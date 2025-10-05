<?php

require_once '../src/services/authentication.php';
require_once '../src/services/contacts.php';

$user = isAuthenticated();

if (isPost()) {
    extract($_POST);
    extract($_FILES);

    $contact = createContact($name, $email, $phone, $photo);
    redirect('/contacts/list');
}

render('contacts/form');
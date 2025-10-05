<?php

require_once '../services/authentication.php';
require_once '../services/contacts.php';

$user = isAuthenticated();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
    ];

    $contact = createContact($data);
    redirect('/contacts/list');
}

include '../views/contacts/form.view.phtml';
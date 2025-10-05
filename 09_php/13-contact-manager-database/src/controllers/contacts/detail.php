<?php

require_once '../src/services/authentication.php';
require_once '../src/services/contacts.php';

$user = isAuthenticated();

$id = $_GET['id'] ?? null;

if ($id === null) {
    http_response_code(400);
    redirect('/contacts/list');
}

$contact = findContactById($id);

render('contacts/detail', ['contact' => $contact]);
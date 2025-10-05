<?php

require_once '../services/authentication.php';
require_once '../services/contacts.php';

$user = isAuthenticated();

$id = $_GET['id'] ?? null;

if ($id === null) {
    http_response_code(400);
    redirect('/contacts/list');
}

$contact = findContactById($id);

include '../views/contacts/detail.view.phtml';
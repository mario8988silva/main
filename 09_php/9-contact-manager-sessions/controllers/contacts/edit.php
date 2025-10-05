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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    
    updateContact($id, [
        'name' => $name,
        'email' => $email,
        'phone' => $phone
    ]);
    redirect('/contacts/detail?id=' . $id);
}

include '../views/contacts/form.view.phtml';
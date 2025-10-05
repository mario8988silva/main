<?php

require_once '../src/services/authentication.php';
require_once '../src/services/contacts.php';

$user = isAuthenticated();

if (!isPost()) {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed'], JSON_PRETTY_PRINT);
    exit();
}

extract($_POST);
extract($_FILES);

$contact = createContact($name, $email, $phone, $photo);

header('Content-Type: application/json');
http_response_code(201);
echo json_encode($contact, JSON_PRETTY_PRINT);
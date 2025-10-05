<?php

require_once '../src/services/authentication.php';
require_once '../src/services/contacts.php';

$user = isAuthenticated();
$filter = $_GET['filter'] ?? null;

$contacts = findAllContacts($filter);

header('Content-Type: application/json');
echo json_encode($contacts, JSON_PRETTY_PRINT);
<?php

require_once '../services/authentication.php';
require_once '../services/contacts.php';

$user = isAuthenticated();
$filter = $_GET['filter'] ?? null;

$contacts = findAllContacts($filter);

header('Content-Type: application/json');
echo json_encode($contacts, JSON_PRETTY_PRINT);
<?php

require_once '../services/authentication.php';
require_once '../services/contacts.php';

$user = isAuthenticated();
$filter = $_GET['filter'] ?? null;

$contacts = findAllContacts($filter);

render('contacts/list', ['contacts' => $contacts, 'filter' => $filter]);
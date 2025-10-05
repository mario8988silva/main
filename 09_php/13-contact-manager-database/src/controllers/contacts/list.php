<?php

require_once '../src/services/authentication.php';
require_once '../src/services/contacts.php';

$user = isAuthenticated();
$filter = $_GET['filter'] ?? null;

$contacts = findAllContacts($filter);

render('contacts/list', ['contacts' => $contacts, 'filter' => $filter]);
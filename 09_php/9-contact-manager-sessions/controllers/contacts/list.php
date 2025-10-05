<?php

require_once '../services/authentication.php';
require_once '../services/contacts.php';

$user = isAuthenticated();
$filter = $_GET['filter'] ?? null;

$contacts = findAllContacts($filter);

include '../views/contacts/list.view.phtml';
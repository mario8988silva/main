<?php

require_once '../src/core/http.php';
require_once '../src/services/authentication.php';
require_once '../src/services/contacts.php';
require_once '../src/services/exporter.php';

isAuthenticated();

$contacts = findAllContacts();

$content = export($contacts, 'csv', true);

$filename = 'export_' . date('Y-m-d_H-i-s') . '.csv';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

echo $content;
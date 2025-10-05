<?php
// 9. This is the controller that handles input and renders the table.

// 10. Retrieves user input from URL
$rows = $_GET['rows'] ?? null;
$cols = $_GET['cols'] ?? null;

// 11. Validates input; returns 400 error if missing
if (is_null($rows) || is_null($cols)) {
    http_response_code(400);
    die('Rows and columns are required.');
}

// 12. Loads the color generator function
require_once 'utils/colors.php';

// 13. Loads the table rendering view
include 'views/draw.view.phtml';

//14. colors.php
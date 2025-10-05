<?php

session_start();

// session_unset(); // remove os dados da sessão
session_destroy(); // destrói a sessão
session_regenerate_id(true); // gera um novo ID de sessão

// unset($_SESSION['counter']); // remove a variável específica 'counter'

$message = "Session deleted successfully.";
header("Location: index.php?message=$message");
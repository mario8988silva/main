<?php

require_once '../src/services/authentication.php';
require_once '../src/core/http.php';

logout();
redirect('/');
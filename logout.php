<?php

require_once __DIR__ . '/core/main_functions.php';

if(isGuest()) {
    redirectToLogin();
}

logOut();

exit(header("Location: /"));
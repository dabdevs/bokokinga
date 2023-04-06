<?php

session_start();

// Se borran las variables de sesión
$_SESSION = array();

// Se borran las cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Se destruye la sesión
session_destroy();

echo json_encode(true);

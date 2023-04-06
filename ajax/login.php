<?php

require_once "../modelos/User.php";

session_start();

$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

$user = new User();

$rspta = $user->authenticate($email, md5($password));

if ($rspta != null) {
    $_SESSION['id'] = $rspta["id"];
    $_SESSION['email'] = $rspta["email"];
    $_SESSION['nombre'] = $rspta["nombre"];
    $_SESSION['apellido'] = $rspta["apellido"];
    $_SESSION['logged_in'] = true;
}

echo json_encode($rspta);

<?php

require_once "../modelos/User.php";

session_start();

$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

$user = new User();

$rspta = $user->authenticateAdmin($email, md5($password));

$user = null;
if ($rspta != null) {
    $user = new stdClass;
    $user->id = $rspta["id"];
    $user->email = $rspta["email"];
    $user->username = $rspta["username"];
    $user->firstname = $rspta["firstname"];
    $user->lastname = $rspta["lastname"];
    $user->logged_in = true;
}

$_SESSION['user'] = $user;

echo json_encode($rspta);

<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class User
{
    //Implementamos nuestro constructor
    public function __construct()
    {
    }

    // Autenticate the user
    public function authenticate($email, $password)
    {
        $sql = "SELECT id, email, nombre, apellido FROM user WHERE email='$email' AND password = '$password'";
        return runQuerySimpleRow($sql);
    }
}

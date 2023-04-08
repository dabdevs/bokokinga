<?php
// Database connection
require "../config/Connection.php";

class User
{
    // Constructor
    public function __construct()
    {
    }

    // Autenticate the user
    public function authenticateAdmin($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email='$email' AND password = '$password' and role = 'ADMIN'";
        return runQuerySimpleRow($sql);
    }
}

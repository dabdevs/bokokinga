<?php
// Database connection
require "../config/Connection.php";

class Autor
{
    // Constructor
    public function __construct()
    {
    }

    // Show data
    public function show($id)
    {
        $sql = "SELECT * FROM autor WHERE id='$id'";
        return runQuerySimpleRow($sql);
    }
}

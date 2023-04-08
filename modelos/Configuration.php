<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Connection.php";

class Configuration
{
    public function __construct()
    {
    }

    // Insert new data
    public function insert($name, $value)
    {
        try {
            $sql = "INSERT INTO configurations (name,value)
        VALUES ('$name','$value')";
            return runQuery($sql);
        } catch (Exception $e) {
            return $e->getCode();
        }
    }

    // Edit existing data
    public function edit($id, $name, $value)
    {
        $sql = "UPDATE configurations SET name='$name', value='$value' WHERE id='$id'";
        return runQuery($sql);
    }

    // Delete existing data
    public function delete($id)
    {
        $sql = "DELETE FROM configurations WHERE id='$id'";
        return runQuery($sql);
    }

    // Show specific data
    public function show($id)
    {
        $sql = "SELECT * FROM configurations WHERE id='$id'";
        return runQuerySimpleRow($sql);
    }

    // List all data
    public function list()
    {
        $sql = "SELECT * FROM configurations";
        return runQuery($sql);
    }
}

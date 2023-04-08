<?php
// Database connection
require "../config/Connection.php";

class Estudiante
{
    public function __construct()
    {
    }

    // Busca un estudiante por cédula
    public function buscar($cedula)
    {
        $sql = "SELECT * FROM estudiante WHERE cedula='$cedula'";
        return runQuerySimpleRow($sql);
    }

    // Lista todos los estudiantes
    public function listar()
    {
        $sql = "SELECT * FROM estudiante";
        return runQuery($sql);
    }

    // Busca un estudiante por Id
    public function show($cedula)
    {
        $sql = "SELECT * FROM estudiante WHERE cedula='$cedula'";
        return runQuerySimpleRow($sql);
    }
}

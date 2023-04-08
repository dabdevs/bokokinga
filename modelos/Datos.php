<?php
// Database connection
require "../config/Connection.php";

class Datos
{
    // Constructor
    public function __construct()
    {
    }
    // Create new data del encabezado
    public function insertarencabezado($cedula, $nombre, $fecha)
    {
        try {
            $sql = "INSERT INTO encabezadoprestamo (cedula, nombre, fecha)
        VALUES ('$cedula','$nombre','$fecha')";
            return runQuery($sql);
        } catch (Exception $e) {
            return $e->getCode();
        }
    }

    // Create new data del datatable
    public function insertardetalle($codigo, $nombre, $fecha, $idprestamo)
    {
        try {
            $sql = "INSERT INTO detalleprestamo (codigo, nombre, fecha, idprestamo)
        VALUES ('$codigo','$nombre','$fecha', '$idprestamo')";
            return runQuery($sql);
        } catch (Exception $e) {
            return $e->getCode();
        }
    }

    // Show data
    public function Obtenerid()
    {
        $sql = "SELECT max(idprestamo) as idprestamo FROM encabezadoprestamo";
        return runQuerySimpleRow($sql);
    }
}

<?php
// Database connection
require "../config/Connection.php";

class Prestamo
{
    // Constructor
    public function __construct()
    {
    }

    private function crear_prestamo($cedula, $nombre, $fechaEstudiante)
    {
        $sql = "INSERT INTO encabezadoprestamo(cedula, nombre, fecha) VALUES('$cedula', '$nombre', '$fechaEstudiante')";
        return runQueryReturnID($sql);
    }

    private function crear_detalle_prestamo($prestamo_id, $cod_libro, $nombre, $fechaLibro)
    {
        $sql = "INSERT INTO detalleprestamo(idprestamo, codigo, nombre, fecha) VALUES('$prestamo_id', '$cod_libro', '$nombre', '$fechaLibro')";
        return runQuery($sql);
    }

    // Create new data
    public function insert($cod_libro, $titulo, $cedula, $nombreEstudiante, $fechaLibro, $fechaEstudiante)
    {
        try {
            global $conexion;
            $conexion->begin_transaction();
            $prestamo = $this->crear_prestamo($cedula, $nombreEstudiante, $fechaEstudiante);
            $res = $this->crear_detalle_prestamo($prestamo, $cod_libro, $titulo, $fechaLibro);
            $conexion->commit();
            return $res;
        } catch (Exception $e) {
            $conexion->rollback();
            return $e->getCode();
        }
    }

    private function update_prestamo($id, $cedula, $nombreEstudiante, $fechaEstudiante)
    {
        $sql = "UPDATE encabezadoprestamo SET cedula = '$cedula', nombre = '$nombreEstudiante', fecha = '$fechaEstudiante' WHERE idprestamo = '$id'";
        return runQuery($sql);
    }

    private function update_detalle_prestamo($detalle_id, $cod_libro, $titulo, $fechaLibro)
    {
        $sql = "UPDATE detalleprestamo SET codigo = '$cod_libro', nombre = '$titulo', fecha = '$fechaLibro' WHERE iddetalle = '$detalle_id'";
        return runQuery($sql);
    }

    // Edit data
    public function edit($id, $detalle_id, $cod_libro, $titulo, $cedula, $nombreEstudiante, $fechaLibro, $fechaEstudiante)
    {
        try {
            global $conexion;
            $conexion->begin_transaction();
            $this->update_prestamo($id, $cedula, $nombreEstudiante, $fechaEstudiante);
            $res = $this->update_detalle_prestamo($detalle_id, $cod_libro, $titulo, $fechaLibro);
            $conexion->commit();
            return $res;
        } catch (Exception $e) {
            $conexion->rollback();
            return $e->getCode();
        }
    }

    // Delete data
    public function delete($id)
    {
        try {
            global $conexion;
            $conexion->begin_transaction();

            $sql1 = "DELETE FROM detalleprestamo WHERE idprestamo='$id'";
            runQuery($sql1);

            $sql2 = "DELETE FROM encabezadoprestamo WHERE idprestamo='$id'";
            $res = runQuery($sql2);

            $conexion->commit();
            return $res;
        } catch (Exception $e) {
            $conexion->rollback();
            return $e->getCode();
        }
    }

    // Show data
    public function show($id)
    {
        $sql = "SELECT ep.idprestamo, ep.cedula, ep.nombre, DATE_FORMAT(ep.fecha, '%Y-%m-%d') as fechaEstudiante, dp.iddetalle, dp.codigo, dp.nombre, DATE_FORMAT(dp.fecha, '%Y-%m-%d') as fechaLibro FROM encabezadoprestamo ep JOIN detalleprestamo dp ON dp.idprestamo = ep.idprestamo WHERE ep.idprestamo='$id'";
        return runQuerySimpleRow($sql);
    }

    // List data
    public function listar()
    {
        $sql = "SELECT ep.idprestamo, ep.cedula, ep.nombre, ep.fecha as estudianteFecha, dp.nombre as titulo, dp.fecha FROM encabezadoprestamo ep JOIN detalleprestamo dp ON dp.idprestamo = ep.idprestamo";
        return runQuery($sql);
    }

    // Busca un autor por código
    public function buscar_autor($cod_autor)
    {
        $sql = "SELECT * FROM autor WHERE codigo = '$cod_autor'";

        return runQuery($sql);
    }

    // Listar autores
    public function listar_autores()
    {
        $sql = "SELECT * FROM autor";
        return runQuery($sql);
    }
}

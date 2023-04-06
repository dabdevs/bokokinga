<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Prestamo
{
    //Implementamos nuestro constructor
    public function __construct()
    {
    }

    private function crear_prestamo($cedula, $nombre, $fechaEstudiante)
    {
        $sql = "INSERT INTO encabezadoprestamo(cedula, nombre, fecha) VALUES('$cedula', '$nombre', '$fechaEstudiante')";
        return ejecutarConsulta_retornarID($sql);
    }

    private function crear_detalle_prestamo($prestamo_id, $cod_libro, $nombre, $fechaLibro)
    {
        $sql = "INSERT INTO detalleprestamo(idprestamo, codigo, nombre, fecha) VALUES('$prestamo_id', '$cod_libro', '$nombre', '$fechaLibro')";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para insertar registros
    public function insertar($cod_libro, $titulo, $cedula, $nombreEstudiante, $fechaLibro, $fechaEstudiante)
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
            return $e->getCode(); // Devuelve el código de error de la excepción
        }
    }

    private function update_prestamo($id, $cedula, $nombreEstudiante, $fechaEstudiante)
    {
        $sql = "UPDATE encabezadoprestamo SET cedula = '$cedula', nombre = '$nombreEstudiante', fecha = '$fechaEstudiante' WHERE idprestamo = '$id'";
        return ejecutarConsulta($sql);
    }

    private function update_detalle_prestamo($detalle_id, $cod_libro, $titulo, $fechaLibro)
    {
        $sql = "UPDATE detalleprestamo SET codigo = '$cod_libro', nombre = '$titulo', fecha = '$fechaLibro' WHERE iddetalle = '$detalle_id'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para editar registros
    public function editar($id, $detalle_id, $cod_libro, $titulo, $cedula, $nombreEstudiante, $fechaLibro, $fechaEstudiante)
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
            return $e->getCode(); // Devuelve el código de error de la excepción
        }
    }

    //Implementamos un método para eliminar registros
    public function eliminar($id)
    {
        try {
            global $conexion;
            $conexion->begin_transaction();

            $sql1 = "DELETE FROM detalleprestamo WHERE idprestamo='$id'";
            ejecutarConsulta($sql1);

            $sql2 = "DELETE FROM encabezadoprestamo WHERE idprestamo='$id'";
            $res = ejecutarConsulta($sql2);

            $conexion->commit();
            return $res;
        } catch (Exception $e) {
            $conexion->rollback();
            return $e->getCode(); // Devuelve el código de error de la excepción
        }
    }

    //Implementar un método para mostrar los datos de un registro a modificar
    public function mostrar($id)
    {
        $sql = "SELECT ep.idprestamo, ep.cedula, ep.nombre, DATE_FORMAT(ep.fecha, '%Y-%m-%d') as fechaEstudiante, dp.iddetalle, dp.codigo, dp.nombre, DATE_FORMAT(dp.fecha, '%Y-%m-%d') as fechaLibro FROM encabezadoprestamo ep JOIN detalleprestamo dp ON dp.idprestamo = ep.idprestamo WHERE ep.idprestamo='$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //Implementar un método para listar los registros
    public function listar()
    {
        $sql = "SELECT ep.idprestamo, ep.cedula, ep.nombre, ep.fecha as estudianteFecha, dp.nombre as titulo, dp.fecha FROM encabezadoprestamo ep JOIN detalleprestamo dp ON dp.idprestamo = ep.idprestamo";
        return ejecutarConsulta($sql);
    }

    // Busca un autor por código
    public function buscar_autor($cod_autor)
    {
        $sql = "SELECT * FROM autor WHERE codigo = '$cod_autor'";

        return ejecutarConsulta($sql);
    }

    // Listar autores
    public function listar_autores()
    {
        $sql = "SELECT * FROM autor";
        return ejecutarConsulta($sql);
    }
}

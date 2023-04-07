<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Libro
{
    //Implementamos nuestro constructor
    public function __construct()
    {
    }

    //Implementamos un método para insertar registros
    public function insertar($cod_libro, $titulo, $genero, $autor_id)
    {
        try {
            $sql_check = "SELECT titulo FROM libro where titulo = '$titulo' OR codigo = '$cod_libro'";
            $res_check = runQuery($sql_check);

            if ($res_check->num_rows > 0) {
                return 1062;
            } else {
                $sql = "INSERT INTO libro(codigo, titulo, genero, autor_id)
                        VALUES ('$cod_libro','$titulo','$genero', '$autor_id')";
                return runQuery($sql);
            }
        } catch (Exception $e) {
            return $e->getCode(); // Devuelve el código de error de la excepción
        }
    }

    //Implementamos un método para editar registros
    public function editar($id, $cod_libro, $titulo, $genero, $autor_id)
    {
        $sql_check = "SELECT id, titulo, codigo FROM libro WHERE titulo = '$titulo'";
        $res_check = runQuery($sql_check);

        if ($res_check->num_rows > 0 && $res_check->fetch_assoc()["id"] != $id) {
            return 1062;
        } else {
            $sql = "UPDATE libro SET titulo='$titulo', genero='$genero', autor_id='$autor_id' WHERE id='$id'";
            return runQuery($sql);
        }
    }

    //Implementamos un método para eliminar registros
    public function eliminar($id)
    {
        $sql = "DELETE FROM libro WHERE id='$id'";
        return runQuery($sql);
    }

    //Implementar un método para mostrar los datos de un registro a modificar
    public function mostrar($cod_libro)
    {
        $sql = "SELECT * FROM libro WHERE codigo='$cod_libro'";
        return runQuerySimpleRow($sql);
    }

    //Implementar un método para listar los registros
    public function listar()
    {
        $sql = "SELECT l.id, l.codigo, l.titulo, l.genero, a.nombre as autor FROM libro l join autor a on l.autor_id = a.id";
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

<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Category
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($id, $nombre)
{
    try {
        $sql="INSERT INTO category (id, nombre)
        VALUES ('$id','$nombre')";
        return ejecutarConsulta($sql);
    } catch (Exception $e) {
        return $e->getCode(); // Devuelve el código de error de la excepción
    }
}

	//Implementamos un método para editar registros
	public function editar($id,$nombre)
	{
		$sql="UPDATE category SET id='$id', nombre='$nombre' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar registros
	public function eliminar($id)
	{	$sql="DELETE FROM category WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql="SELECT * FROM category WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function list()
	{
		$sql="SELECT * FROM category";
		return ejecutarConsulta($sql);		
	}
}

?>
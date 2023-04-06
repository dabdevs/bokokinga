<?php 
//Importamos la clase Datos.php
require_once "../modelos/Datos.php";
// Instaciamos la clase Datos
$datos=new Datos();

// Recibir el encabezado enviado por AJAX
$encabezado=$_POST['encabezado'];
$cedula = $encabezado['cedula'];
$nombre = $encabezado['nombre'];
$fecha = $encabezado['fecha'];
$fechaformato = date('Y-m-d', strtotime($fecha));
$datos->insertarencabezado($cedula, $nombre, $fechaformato);
$idprestamo=$datos->Obtenerid();


// Recibir el detalle enviado por AJAX
$detalle = json_decode($_POST['detalle'], true);
foreach ($detalle as $dato) {
    $codigo = $dato[0];
    $nombre = $dato[1];
    $fecha = date('Y-m-d', strtotime($dato[2]));
    $rspta=$datos->insertardetalle($codigo,$nombre,$fecha, $idprestamo['idprestamo']);
			if (intval($rspta)==1){
				echo "Datos Insertados";
			}
			else
            {
				echo "Error al Insertar los datos";
			}
}
?>
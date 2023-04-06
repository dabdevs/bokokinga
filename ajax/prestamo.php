<?php

require_once "../modelos/Prestamo.php";

$prestamo = new Prestamo();

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$detalle_id = isset($_POST["detalleId"]) ? $_POST["detalleId"] : "";
$cod_libro = isset($_POST["cod_libro"]) ? $_POST["cod_libro"] : "";
$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
$nombreEstudiante = isset($_POST["nombreEstudiante"]) ? $_POST["nombreEstudiante"] : "";
$fechaLibro = isset($_POST["fechaLibro"]) ? $_POST["fechaLibro"] : "";
$fechaEstudiante = isset($_POST["fechaEstudiante"]) ? $_POST["fechaEstudiante"] : "";

switch ($_GET["op"]) {
    case 'guardar':
        $rspta = $prestamo->insertar($cod_libro, $titulo, $cedula, $nombreEstudiante, $fechaLibro, $fechaEstudiante);
        if (intval($rspta) == 1) {
            echo "Prestamo Agregado";
        }
        if (intval($rspta) == 1062) {
            echo "Prestamo ya existe";
        }
        break;

    case 'editar':
        $rspta = $prestamo->editar($id, $detalle_id, $cod_libro, $titulo, $cedula, $nombreEstudiante, $fechaLibro, $fechaEstudiante);

        if (intval($rspta) == 1062) {
            echo "Prestamo ya existe";
        } else {
            echo "Prestamo editado";
        }

        break;

    case 'eliminar':
        $rspta = $prestamo->eliminar($id);
        echo $rspta ? "Prestamo eliminado" : "Prestamo no se pudo eliminar";

        break;

    case 'mostrar':
        $rspta = $prestamo->mostrar($id);

        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $prestamo->listar();
        //Vamos a declarar un array
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->idprestamo,
                "1" => $reg->cedula,
                "2" => $reg->nombre,
                "3" => $reg->titulo,
                "4" => $reg->fecha,
                "5" => '<button class="btn btn-primary" onclick="mostrar(\'' . $reg->idprestamo . '\')"><i class="bx bx-search"></i>&nbsp;Seleccionar</button>'
            );
        }
        $results = array(
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);

        break;
}

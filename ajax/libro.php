<?php

require_once "../modelos/Libro.php";

$libro = new Libro();

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$cod_libro = isset($_POST["cod_libro"]) ? $_POST["cod_libro"] : "";
$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
$genero = isset($_POST["genero"]) ? $_POST["genero"] : "";
$autor_id = isset($_POST["autor_id"]) ? $_POST["autor_id"] : "";
$cod_autor = isset($_POST["cod_autor"]) ? $_POST["cod_autor"] : "";

switch ($_GET["op"]) {
    case 'guardar':
        $rspta = $libro->insert($cod_libro, $titulo, $genero, $autor_id);
        if (intval($rspta) == 1) {
            echo "Libro Agregado";
        }
        if (intval($rspta) == 1062) {
            echo "Libro ya existe";
        }
        break;

    case 'editar':
        $rspta = $libro->edit($id, $cod_libro, $titulo, $genero, $autor_id);

        if (intval($rspta) == 1062) {
            echo "Libro ya existe";
        } else {
            echo "Libro editado";
        }

        break;

    case 'eliminar':
        $rspta = $libro->delete($id);
        echo $rspta ? "Libro eliminado" : "Libro no se pudo eliminar";

        break;

    case 'mostrar':
        $rspta = $libro->show($cod_libro);

        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $libro->listar();
        //Vamos a declarar un array
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->id,
                "1" => $reg->codigo,
                "2" => $reg->titulo,
                "3" => $reg->genero,
                "4" => $reg->autor,
                "5" => '<button class="btn btn-primary" onclick="selectLibro(\'' . $reg->codigo . '\')"><i class="bx bx-search"></i>&nbsp;Seleccionar</button>'
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

    case 'buscar_autor':
        $rspta = $libro->buscar_autor($cod_autor);
        //Codificar el resultado utilizando json
        echo json_encode($rspta->fetch_assoc());
        break;

    case 'listar_autores':
        $rspta = $libro->listar_autores();

        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->id,
                "1" => $reg->codigo,
                "2" => $reg->nombre,
                "3" => $reg->nacionalidad,
                "4" => '<button class="btn btn-primary" onclick="selectAutor(\'' . $reg->id . '\')"><i class="bx bx-search"></i>&nbsp;Seleccionar</button>'
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

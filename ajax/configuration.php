<?php

require_once "../modelos/Configuration.php";

$configuration = new Configuration();

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$value = isset($_POST["value"]) ? $_POST["value"] : "";

switch ($_GET["op"]) {
    case 'save':
        $rspta = $configuration->insert($name, $value);
        if (intval($rspta) == 1) {
            echo "Configuración Agregada";
        }
        if (intval($rspta) == 1062) {
            echo "Codigo de Configuración Repetida";
        }
        break;

    case 'edit':
        $rspta = $configuration->edit($id, $name, $value);
        echo $rspta ? "Configuración actualizada" : "Configuración no se pudo actualizar";

        break;

    case 'delete':
        $rspta = $configuration->delete($id);
        echo $rspta ? "Configuración eliminada" : "Configuración no se pudo eliminar";

        break;

    case 'show':
        $rspta = $configuration->show($id);
        echo json_encode($rspta);
        break;

    case 'list':
        $rspta = $configuration->list();
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->name,
                "1" => $reg->value,
                "2" => '<button class="btn btn-warning" onclick="edit(\'' . $reg->id . '\')"><i class="bx bx-pencil"></i>&nbsp;Editar</button><button class="btn btn-danger ml-2" onclick="showModal(\'' . $reg->id . '\')"><i class="bx bx-trash"></i>&nbsp;Eliminar</button>'
            );
        }
        $results = array(
            "sEcho" => 1, // Information for datatable
            "iTotalRecords" => count($data), // Send number of records to datatable
            "iTotalDisplayRecords" => count($data), // Send number of records to show
            "aaData" => $data
        );
        echo json_encode($results);

        break;
}

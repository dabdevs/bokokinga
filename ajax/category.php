<?php

require_once "../modelos/category.php";

$category = new Category();

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$description = isset($_POST["description"]) ? $_POST["description"] : "";
$image = isset($_POST["image"]) ? $_POST["image"] : "";

switch ($_GET["op"]) {
	case 'save':
		$rspta = $category->insert($name, $description, $image);
		if (intval($rspta) == 1) {
			echo "Categoria Agregada";
		}
		if (intval($rspta) == 1062) {
			echo "Codigo de Categoria Repetida";
		}
		break;

	case 'edit':
		$rspta = $category->edit($id, $name, $description, $image);
		echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";

		break;

	case 'eliminar':
		$rspta = $category->delete($id);
		echo $rspta ? "Categoría eliminada" : "Categoría no se pudo eliminar";

		break;

	case 'show':
		$rspta = $category->show($id);
		echo json_encode($rspta);
		break;

	case 'list':
		$rspta = $category->list(); 
		$data = array();

		while ($reg = $rspta->fetch_object()) {
			$data[] = array(
				"0" => $reg->name,
				"1" => $reg->description,
				"2" => $reg->image,
				"3" => '<button class="btn btn-warning" onclick="edit(\'' . $reg->id . '\')"><i class="bx bx-pencil"></i>&nbsp;Editar</button><button class="btn btn-danger ml-2" onclick="showModal(\'' . $reg->id . '\')"><i class="bx bx-trash"></i>&nbsp;Eliminar</button>'
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

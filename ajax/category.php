<?php 

require_once "../modelos/Category.php";

$categoria = new Category();

$id=isset($_POST["id"])? $_POST["id"]:"";
$nombre=isset($_POST["nombre"])? $_POST["nombre"]:"";

switch ($_GET["op"]){
	case 'guardar':
			$rspta=$categoria->insertar($id,$nombre);
			if (intval($rspta)==1){
				echo "Categoria Agregada";
			}
			if (intval($rspta)==1062){
				echo "Codigo de Categoria Repetida";
			}
			break;

		case 'editar':
			$rspta=$categoria->editar($id,$nombre);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		
			break;

			case 'eliminar':
				$rspta=$categoria->eliminar($id);
				echo $rspta ? "Categoría eliminada" : "Categoría no se pudo eliminar";
			
				break;

	case 'mostrar':
		$rspta=$categoria->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	
	case 'list':
		$rspta=$categoria->list();

 		$data = $rspta->fetch_array();

		var_dump($data); die;

 		echo json_encode($data);

		break;

	case 'listTable':
		$rspta = $categoria->list();
		//Vamos a declarar un array
		$data = array();

		while ($reg = $rspta->fetch_object()) {
			$data[] = array(
				"0" => $reg->id,
				"1" => $reg->name,
				"2" => '<button class="btn btn-primary" onclick="mostrar(\'' . $reg->id . '\')"><i class="bx bx-search"></i>&nbsp;Seleccionar</button>'
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

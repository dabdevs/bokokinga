<?php

require_once "../modelos/category.php";

function resizeImage($file, $target_dir, $max_width, $max_height) {
	
	$filename = $file['tmp_name'];

	// Create the directory if it doesn't exist
	if (!file_exists($target_dir)) {
		mkdir($target_dir, 0777, true);
	}

	list($width, $height, $type) = getimagesize($filename);

	// Calculate new dimensions while preserving aspect ratio
	
	$aspectRatio = $width / $height;
	if ($aspectRatio > 1 && $width > $max_width) {
		$new_width = $max_width;
		$new_height = $max_width / $aspectRatio;
	} elseif ($aspectRatio <= 1 && $height > $max_height) {
		$new_height = $max_height;
		$new_width = $max_height * $aspectRatio;
	} else {
		// Image is already smaller than max dimensions
		$new_width = $max_width;
		$new_height = $max_height;
	}
	
	// var_dump($width, $height); die;
	$image_p = imagecreatetruecolor((int)$new_width, (int)$new_height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, (int)$new_width, (int)$new_height, (int)$width, (int)$height);

	// Output
	imagejpeg($image_p, $target_dir .'/'. $file['name']);
	
	return $file['name'];
}

function uploadFile($file, $target_dir, $width=null, $height=null) {
	if ($file != "") {
		return resizeImage($file, $target_dir, $width, $height);
	}

	return null;
}

$category = new Category();

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$description = isset($_POST["description"]) ? $_POST["description"] : "";
$image = isset($_FILES["image"]) ? $_FILES["image"] : "";

switch ($_GET["op"]) {
	case 'save':
		$upload_dir = $_SERVER["DOCUMENT_ROOT"].CATEGORY_IMG_PATH;
		$filename = uploadFile($image, $upload_dir, CATEGORY_IMAGE_WIDTH, CATEGORY_IMAGE_HEIGTH);

		if ($filename != null) {
			$rspta = $category->insert($name, $description, $filename);
			if (intval($rspta) == 1) {
				echo "Categoria Agregada";
			}
			if (intval($rspta) == 1062) {
				echo "Codigo de Categoria Repetida";
			}
		}
		break;

	case 'edit':
		$upload_dir = $_SERVER["DOCUMENT_ROOT"].CATEGORY_IMG_PATH;
		$filename = uploadFile($image, $upload_dir, CATEGORY_IMAGE_WIDTH, CATEGORY_IMAGE_HEIGTH);
		
		// If the file was uploaded successfully
		if ($filename != null) {
			$rspta = $category->edit($id, $name, $description, $filename);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}

		break;

	case 'delete':
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




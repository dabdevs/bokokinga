<?php

require_once "../modelos/Collection.php";
require_once("../modelos/S3.php");

$collection = new Collection();
$upload_dir = 'collections';
$filename = '';

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$description = isset($_POST["description"]) ? $_POST["description"] : "";
$image = isset($_FILES["image"]) && $_FILES["image"]["tmp_name"] != "" ? $_FILES["image"] : null;


function resizeImage($file, $max_width, $max_height)
{
	$filename = $file['tmp_name'];

	list($orig_width, $orig_height) = getimagesize($filename);

	/*
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

	$image_p = imagecreatetruecolor((int)$new_width, (int)$new_height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, (int)$new_width, (int)$new_height, (int)$width, (int)$height);
	
	*/

	// Calculate the new dimensions for the resized image
	$width_ratio = $max_width / $orig_width;
	$height_ratio = $max_height / $orig_height;
	$ratio = min($width_ratio, $height_ratio);
	$new_width = (int) ($orig_width * $ratio);
	$new_height = (int) ($orig_height * $ratio);

	// Create a new image with the resized dimensions
	$resized_image = imagecreatetruecolor($new_width, $new_height);

	// Load the original image into memory
	$src_image = imagecreatefromjpeg($filename);

	// Resize the original image and copy it to the new image
	imagecopyresampled($resized_image, $src_image, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);

	// Save the resized image to a file
	imagejpeg($resized_image, $file['name']);

	// Free up memory
	imagedestroy($src_image);
	imagedestroy($resized_image);


	// Output
	// imagejpeg($image_p, $target_dir . '/' . $file['name']);

	return $file;
}

function uploadImage($file, $target_dir, $max_width = null, $max_height = null)
{
	// Create the directory if it doesn't exist
	if (!file_exists($target_dir)) {
		mkdir($target_dir, 0777, true);
	}

	if ($max_width != null && $max_height != null)
		$new_file = resizeImage($file, $max_width, $max_height);

	/*
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

	$image_p = imagecreatetruecolor((int)$new_width, (int)$new_height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, (int)$new_width, (int)$new_height, (int)$width, (int)$height);

	// Output
	// imagejpeg($image_p, $target_dir . '/' . $file['name']);

	*/

	$s3 = new S3;
	
	$s3->putObject($target_dir . '/' . $file['name'], file_get_contents($new_file['tmp_name']));

	return $file["name"];
}


switch ($_GET["op"]) {
	case 'save':
		if ($image != null) {
			$extension = explode(".", $image["name"])[1];
			$random_string = bin2hex(random_bytes(16));
			$image["name"] = hash('sha256', $random_string) . "." . $extension;
			$filename = uploadImage($image, $upload_dir, COLLECTION_INDEX_IMAGE_WIDTH, COLLECTION_INDEX_IMAGE_HEIGTH);
		}

		$rspta = $collection->insert($name, $description, $filename);
		if (intval($rspta) == 1) {
			echo "Categoria Agregada";
		}
		if (intval($rspta) == 1062) {
			echo "Codigo de Categoria Repetida";
		}
		break;

	case 'edit':
		$stored_img = $collection->show($id)["image"];

		// If image was previously updated, get the filename
		if ($stored_img != null) {
			$image["name"] = $stored_img;
		} else {
			$extension = explode(".", $image["name"])[1];
			$random_string = bin2hex(random_bytes(16));
			$image["name"] = hash('sha256', $random_string) . "." . $extension;
		}

		// If uploading new image
		if (isset($image["tmp_name"])) { 
			$filename = uploadImage($image, $upload_dir, COLLECTION_INDEX_IMAGE_WIDTH, COLLECTION_INDEX_IMAGE_HEIGTH);
		} else {
			// Delete image if it exists
			if ($stored_img != null) {
				$s3 = new S3;
				$s3->deleteObject($upload_dir . "/" . $stored_img);
				$filename = "";
			}
		}
		
		$rspta = $collection->edit($id, $name, $description, $filename);
		echo $rspta ? "Colección actualizada" : "Colección no se pudo actualizar";

		break;

	case 'delete':
		$rspta = $collection->delete($id);
		echo $rspta ? "Colección eliminada" : "Colección no se pudo eliminar";

		break;

	case 'show':
		$rspta = $collection->show($id);
		echo json_encode($rspta);
		break;

	case 'list':
		$rspta = $collection->list();
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

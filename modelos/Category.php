<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Connection.php";

class Category
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}

	// Insert new data
	public function insert($name, $description, $image)
	{
		try {
			$sql = "INSERT INTO categories (name,description,image)
        VALUES ('$name','$description','$image')";
			return runQuery($sql);
		} catch (Exception $e) {
			return $e->getCode();
		}
	}

	// Edit existing data
	public function edit($id, $name, $description, $image)
	{
		$sql = "UPDATE categories SET name='$name', description='$description', image='$image' WHERE id='$id'";
		return runQuery($sql);
	}

	// Delete existing data
	public function delete($id)
	{
		$sql = "DELETE FROM categories WHERE id='$id'";
		return runQuery($sql);
	}

	// Show specific data
	public function show($id)
	{
		$sql = "SELECT * FROM categories WHERE id='$id'";
		return runQuerySimpleRow($sql);
	}

	// List all data
	public function list()
	{
		$sql = "SELECT * FROM categories";
		return runQuery($sql);
	}

	// Get all products of the category
	public function products($name)
	{
		$sql = "SELECT c.description as collection_description, p.* FROM products p
            JOIN categories c ON p.category_id = c.id 
            WHERE c.name = '$name'";

		$collection =  runQuery($sql);

		while ($reg = $collection->fetch_object()) {
			$data[] = (object)[
				"c_description" => $reg->collection_description,
				"id" => $reg->id,
				"name" => $reg->name,
				"image1" => $reg->image1,
				"p_description" => $reg->description,
				"price" => $reg->price,
				"slug" => $reg->slug
			];
		}

		return $data;
	}
}

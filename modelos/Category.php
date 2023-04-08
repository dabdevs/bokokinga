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
}

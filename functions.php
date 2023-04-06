<?php
require "./config/Conexion.php";

function getCategories() {

    $sql = "SELECT * FROM categories";
    $categories =  ejecutarConsulta($sql);

    $data = array();

    while ($reg = $categories->fetch_object()) {
        $data[] = (object)[
            "id" => $reg->id,
            "name" => $reg->name,
            "description" => $reg->description,
            "image" => $reg->image
        ];
    }

    return $data;
}
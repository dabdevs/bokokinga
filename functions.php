<?php
require "./config/Connection.php";

function getCategories()
{

    $sql = "SELECT * FROM categories";
    $categories =  runQuery($sql);

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

function getConfigurations()
{
    $sql = "SELECT * FROM configurations";
    $configurations =  runQuery($sql);

    $data = array();

    while ($reg = $configurations->fetch_object()) {
        $data[$reg->name] = $reg->value;
    }

    return $data;
}

function getIndexData()
{
    $configurations = getConfigurations();

    $sql_latest1 = "SELECT p.*, c.name as row_title, c.description as row_description FROM products p, categories c WHERE c.id = p.category_id AND category_id = " . $configurations[LATEST_ROW_1];
    $sql_latest2 = "SELECT p.*, c.name as row_title, c.description as row_description FROM products p, categories c WHERE c.id = p.category_id AND category_id = " . $configurations[LATEST_ROW_2];
    $sql_latest3 = "SELECT p.*, c.name as row_title, c.description as row_description FROM products p, categories c WHERE c.id = p.category_id AND category_id = " . $configurations[LATEST_ROW_1];

    $data = array();

    $latest_first_row = runQuery($sql_latest1);
    $latest_second_row = runQuery($sql_latest2);
    $latest_third_row = runQuery($sql_latest3);

    $data["latest_first_row"] = new stdClass;
    $data["latest_second_row"] = new stdClass;
    $data["latest_third_row"] = new stdClass;

    while ($reg = $latest_first_row->fetch_assoc()) {
        $data["latest_first_row"]->products[] = (object)$reg;
        $data["latest_first_row"]->title = $reg["row_title"];
        $data["latest_first_row"]->description = $reg["row_description"];
    }

    while ($reg = $latest_second_row->fetch_assoc()) {
        $data["latest_second_row"]->products[] = (object)$reg;
        $data["latest_second_row"]->title = $reg["row_title"];
        $data["latest_second_row"]->description = $reg["row_description"];
    }

    while ($reg = $latest_third_row->fetch_assoc()) {
        $data["latest_third_row"]->products[] = (object)$reg;
        $data["latest_third_row"]->title = $reg["row_title"];
        $data["latest_third_row"]->description = $reg["row_description"];
    }

    return $data;
}

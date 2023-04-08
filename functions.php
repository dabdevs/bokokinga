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

    $sql_latest1 = "SELECT p.*, c.name as row_title, c.description as row_description FROM products p, categories c WHERE c.id = p.category_id AND category_id = " . $configurations[LATEST_PRODUCTS_CATEGORY_1];
    $sql_latest2 = "SELECT p.*, c.name as row_title, c.description as row_description FROM products p, categories c WHERE c.id = p.category_id AND category_id = " . $configurations[LATEST_PRODUCTS_CATEGORY_2];
    $sql_latest3 = "SELECT p.*, c.name as row_title, c.description as row_description FROM products p, categories c WHERE c.id = p.category_id AND category_id = " . $configurations[LATEST_PRODUCTS_CATEGORY_3];
    
    $data = array();
    $data["configurations"] = $configurations;

    $latest_products_category_1 = runQuery($sql_latest1);
    $latest_products_category_2 = runQuery($sql_latest2);
    $latest_products_category_3 = runQuery($sql_latest3);

    $data["latest_products_category_1"] = new stdClass;
    $data["latest_products_category_2"] = new stdClass;
    $data["latest_products_category_3"] = new stdClass;

    while ($reg = $latest_products_category_1->fetch_assoc()) {
        $data["latest_products_category_1"]->products[] = (object)$reg;
        $data["latest_products_category_1"]->title = $reg["row_title"];
        $data["latest_products_category_1"]->description = $reg["row_description"];
    }

    while ($reg = $latest_products_category_2->fetch_assoc()) {
        $data["latest_products_category_2"]->products[] = (object)$reg;
        $data["latest_products_category_2"]->title = $reg["row_title"];
        $data["latest_products_category_2"]->description = $reg["row_description"];
    }

    while ($reg = $latest_products_category_3->fetch_assoc()) {
        $data["latest_products_category_3"]->products[] = (object)$reg;
        $data["latest_products_category_3"]->title = $reg["row_title"];
        $data["latest_products_category_3"]->description = $reg["row_description"];
    }

    return $data;
}

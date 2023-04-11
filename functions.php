<?php

require "./config/Connection.php";

function getCollections()
{
    /*
    if (isset($_COOKIE['collections']))
        return unserialize($_COOKIE['collections']);
    */

    $sql = "SELECT * FROM categories";
    $collections =  runQuery($sql);

    $data = array();

    while ($reg = $collections->fetch_object()) {
        $data[] = (object)[
            "id" => $reg->id,
            "name" => $reg->name,
            "description" => $reg->description,
            "image" => $reg->image
        ];
    }

    setcookie('collections', serialize($data), time() + 3600, '/');

    return $data;
}

function getConfigurations()
{
    $sql = "SELECT * FROM configurations";
    $configurations = runQuery($sql);

    $data = array();

    while ($reg = $configurations->fetch_object()) {
        $data[$reg->name] = $reg->value;
    }

    return $data;
}

function getCollection($name)
{
    // Get total of records
    $sql_total = "SELECT c.description as collection_description, p.* FROM products p
                JOIN categories c ON p.category_id = c.id 
                WHERE c.name = '$name'";

    $total_products =  runQuery($sql_total);
    $total_records = $total_products->num_rows;

    $total_pages = ceil($total_records / RECORDS_PER_PAGE);
    $current_page = isset($_GET['page']) && $_GET['page'] != "" ? $_GET['page'] : 1;

    $offset = ($current_page - 1) * RECORDS_PER_PAGE;

    $sql_per_page = $sql_total . " LIMIT $offset, " . RECORDS_PER_PAGE;

    $collection = runQuery($sql_per_page);

    $links = '';
    $uri = 'collection.php?name=' . $_GET['name'];

    for ($i = 1; $i <= $total_pages; $i++) {
        $links .= "<li><a href='$uri&page=$i'>$i</a></li>";
    }

    $data = array();
    $data["collection_description"] = $total_products->fetch_assoc()["collection_description"];
    $data["products"] = array();

    while ($reg = $collection->fetch_object()) {
        $data["products"][] = (object)[
            "c_description" => $reg->collection_description,
            "id" => $reg->id,
            "name" => $reg->name,
            "image1" => $reg->image1,
            "p_description" => $reg->description,
            "price" => $reg->price,
            "slug" => $reg->slug
        ];
    }

    $data["links"] = $links;

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

    setcookie('home_data', serialize($data), time() + 3600, '/');

    return $data;
}

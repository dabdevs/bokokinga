<?php

require_once "../modelos/Autor.php";

$autor = new Autor();

$id = isset($_POST["id"]) ? $_POST["id"] : "";

switch ($_GET["op"]) {
    case 'mostrar':
        $rspta = $autor->mostrar($id);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;
}

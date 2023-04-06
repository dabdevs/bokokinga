<?php
$title = 'Categoría';
ob_start();
?>

<style>
    #listadoregistros {
        display: none;
    }
</style>

<h1 class="display-4"><?= $title ?></h1>

<div class="mb-3 card p-3">
    <div class="row">
        <div class="col-sm-3">
            <label for="id">ID:</label>
            <input class="form-control" type="text" id="id" name="id">
        </div>
        <div class="col-sm-3">
            <label for="nombre">Nombre:</label>
            <input class="form-control" type="text" id="nombre" name="nombre">
        </div>
    </div>
    <div class="row p-3">
        <button type="button" class="col mr-1 btn btn-success" id="Agregar" onclick="agregar()">Agregar</button>
        <button type="button" class="col mr-1 btn btn-primary" id="Listar" onclick="listar()">Buscar</button>
        <button type="button" class="col mr-1 btn btn-warning" id="Editar" onclick="editar()" disabled>Editar</button>
        <button type="button" class="col mr-1 btn btn-danger" id="Eliminar" onclick="eliminar()" disabled>Eliminar</button>
        <button type="button" class="col mr-1 btn btn-secondary" id="Limpiar" onclick="limpiar()">Limpiar</button>
    </div>
</div>

<div class="mb-3 card p-3" id="listadoregistros">
    <div class="row table-responsive pl-3">
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Opciones</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th>Id</th>
                <th>Nombre</th>
                <th>Opciones</th>
            </tfoot>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
include './includes/layout.php';
?>

<script>
    listar();

    function habilitar_botones() {
        document.getElementById("Agregar").disabled = true;
        document.getElementById("Eliminar").disabled = false;
        document.getElementById("Editar").disabled = false;
    }

    function desabilitar_botones() {
        document.getElementById("Agregar").disabled = false;
        document.getElementById("Eliminar").disabled = true;
        document.getElementById("Editar").disabled = true;
    }

    function agregar() {
        var id = $("#id").val();
        var nombre = $("#nombre").val();
        if (id == '' || nombre == '') {
            Swal.fire('Faltan Datos');
        } else {
            $.ajax({
                type: "POST",
                url: "../ajax/categoria.php?op=guardar",
                data: {
                    id: id,
                    nombre: nombre
                },
                success: function(response) {
                    Swal.fire(response);
                    limpiar();
                }
            });
        }
    }

    function eliminar() {
        var id = $("#id").val();
        var nombre = $("#nombre").val();

        $.ajax({
            type: "POST",
            url: "../ajax/categoria.php?op=eliminar",
            data: {
                id: id,
                nombre: nombre
            },
            success: function(response) {
                Swal.fire(response);
                limpiar();
            }
        });
    }

    function editar() {
        var id = $("#id").val();
        var nombre = $("#nombre").val();

        $.ajax({
            type: "POST",
            url: "../ajax/categoria.php?op=editar",
            data: {
                id: id,
                nombre: nombre
            },
            success: function(response) {
                Swal.fire(response);
            }
        }).done(function() {
            listar();
        });
    }

    function buscar() {
        var id = $("#id").val();


        $.ajax({
            type: "POST",
            url: "../ajax/categoria.php?op=mostrar",
            data: {
                id: id
            },
            success: function(response) {
                alert(response);
                var resultado = JSON.parse(response);
                document.getElementById("id").value = resultado['id'];
                document.getElementById("nombre").value = resultado['nombre'];

            }
        });
    }

    function mostrar(idcategoria) {
        habilitar_botones();
        document.getElementById("listadoregistros").style.display = "none";
        $.ajax({
            type: "POST",
            url: "../ajax/categoria.php?op=mostrar",
            data: {
                id: idcategoria
            },
            success: function(response) {
                //alert(response);
                var resultado = JSON.parse(response);
                document.getElementById("id").value = resultado['id'];
                document.getElementById("nombre").value = resultado['nombre'];
            }
        });
    }

    function limpiar() {
        document.getElementById("id").value = "";
        document.getElementById("nombre").value = "";
        desabilitar_botones();
    }

    //Función Listar
    function listar() {

        document.getElementById("listadoregistros").style.display = "block";
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
            "ajax": {
                url: "../ajax/categoria.php?op=listar",
                type: "get",
                dataType: "json",
                error: function(e) {
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 5, //Paginación
            "order": [
                [0, "asc"]
            ] //Ordenar (columna,orden)
        }).DataTable();
    }
</script>
</body>

</html>
<?php
$title = 'Libro';
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
            <label for="cod_libro">Código Libro:</label>
            <input class="form-control" type="text" id="cod_libro" name="cod_libro">
            <input type="hidden" name="libro_id" id="libro_id">
        </div>
        <div class="col-sm-3">
            <label for="titulo">Título:</label>
            <input class="form-control" type="text" id="titulo" name="titulo">
        </div>
        <div class="col-sm-3">
            <label for="genero">Genero:</label>
            <input class="form-control" type="text" id="genero" name="genero">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label for="cod_autor">Código Autor:</label>
            <div class="d-flex flex-row justify-content-between">
                <div class="pr-md-2">
                    <input class="form-control" type="text" id="cod_autor" name="cod_autor" onblur="buscarAutor()">
                    <input type="hidden" name="autor_id" id="autor_id">
                    <small class="text-danger" id="cod-autor-feedback"></small>
                </div>

                <div class="">
                    <button class="float-right btn btn-primary" id="listar-autor" onclick="listarAutores()">Buscar</button>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="autor">Nombre Autor:</label>
            <input class="form-control" type="text" id="autor" name="autor" readonly>
        </div>
    </div>
    <div class="row p-3">
        <button type="button" class="col mr-1 btn btn-success" id="Agregar" onclick="agregar()">Agregar</button>
        <button type="button" class="col mr-1 btn btn-primary" id="Listar" onclick="listar()">Buscar</button>
        <button type="button" class="col mr-1 btn btn-warning" id="Editar" onclick="edit()" disabled>Editar</button>
        <button type="button" class="col mr-1 btn btn-danger" id="Eliminar" onclick="delete()" disabled>Eliminar</button>
        <button type="button" class="col mr-1 btn btn-secondary" id="Limpiar" onclick="limpiar()">Limpiar</button>
    </div>
</div>

<div class="mb-3 card p-3" id="listadoregistros">
    <div class="row table-responsive pl-3 d-none" id="listaAutores">
        <table id="tbllistadoAutores" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Id</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Nacionalidad</th>
                <th>Opciones</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th>Id</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Nacionalidad</th>
                <th>Opciones</th>
            </tfoot>
        </table>
    </div>
    <div class="row table-responsive pl-3" id="listaLibros">
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Id</th>
                <th>Código</th>
                <th>Título</th>
                <th>Género</th>
                <th>Autor</th>
                <th>Opciones</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th>Id</th>
                <th>Código</th>
                <th>Título</th>
                <th>Género</th>
                <th>Autor</th>
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
        var cod_libro = $("#cod_libro").val().trim();
        var titulo = $("#titulo").val().trim();
        var genero = $("#genero").val().trim();
        var autor_id = $("#autor_id").val().trim();

        if (cod_libro == '' || titulo == '' || genero == '' || autor_id == '') {
            Swal.fire('Faltan Datos');
        } else {
            $.ajax({
                type: "POST",
                url: "../ajax/libro.php?op=guardar",
                data: {
                    cod_libro,
                    titulo,
                    genero,
                    autor_id
                },
                success: function(response) {
                    Swal.fire(response);
                    limpiar();
                    listar();
                }
            });
        }
    }

    function delete() {
        var id = $("#libro_id").val();

        $.ajax({
            type: "POST",
            url: "../ajax/libro.php?op=eliminar",
            data: {
                id
            },
            success: function(response) {
                Swal.fire(response);
                limpiar();
                listar();
            }
        });
    }

    function edit() {
        var id = $("#libro_id").val();
        var cod_libro = $("#cod_libro").val().trim();
        var titulo = $("#titulo").val().trim();
        var genero = $("#genero").val().trim();
        var autor_id = $("#autor_id").val().trim();

        $.ajax({
            type: "POST",
            url: "../ajax/libro.php?op=editar",
            data: {
                id,
                cod_libro,
                titulo,
                genero,
                autor_id
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
            url: "../ajax/libro.php?op=mostrar",
            data: {
                id: id
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                document.getElementById("id").value = resultado['id'];
                document.getElementById("nombre").value = resultado['nombre'];

            }
        });
    }

    function show(id) {
        habilitar_botones();
        document.getElementById("listadoregistros").style.display = "none";
        $.ajax({
            type: "POST",
            url: "../ajax/libro.php?op=mostrar",
            data: {
                id
            },
            success: function(response) {
                var resultado = JSON.parse(response);

                document.getElementById("libro_id").value = resultado['id'];
                document.getElementById("cod_libro").value = resultado['codigo'];
                document.getElementById("titulo").value = resultado['titulo'];
                document.getElementById("genero").value = resultado['genero'];
                document.getElementById("autor").value = resultado['autor'];
                document.getElementById("cod_autor").value = resultado['cod_autor'];
            }
        });
    }

    function limpiar() {
        document.getElementById("cod_libro").value = "";
        document.getElementById("titulo").value = "";
        document.getElementById("genero").value = "";
        document.getElementById("cod_autor").value = "";
        document.getElementById("autor").value = "";
        document.getElementById("autor_id").value = "";
        desabilitar_botones();
    }

    //Función Listar
    function listar() {
        document.getElementById("listadoregistros").style.display = "block";
        document.getElementById("listaAutores").classList.add("d-none");
        document.getElementById("listaLibros").classList.remove("d-none");

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
                url: "../ajax/libro.php?op=listar",
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

    //Listar Autores
    function listarAutores() {
        document.getElementById("listadoregistros").style.display = "block";
        document.getElementById("listaAutores").classList.remove("d-none");
        document.getElementById("listaLibros").classList.add("d-none");

        tabla = $('#tbllistadoAutores').dataTable({
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
                url: "../ajax/libro.php?op=listar_autores",
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

    function selectAutor(id) {
        var $autor_id = document.getElementById('autor_id')
        var $cod_autor = document.getElementById('cod_autor')
        var $autor = document.getElementById('autor')
        var $feedback = document.getElementById('cod-autor-feedback').innerText = ''

        desabilitar_botones();
        $.ajax({
            type: "POST",
            url: "../ajax/autor.php?op=mostrar",
            data: {
                id
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                $autor.value = resultado.nombre;
                $autor_id.value = resultado.id;
                $cod_autor.value = resultado.codigo;
            }
        });
    }

    function buscarAutor() {
        var cod_autor = document.getElementById('cod_autor').value
        var $autor = document.getElementById('autor')
        var $autor_id = document.getElementById('autor_id')
        var $feedback = document.getElementById('cod-autor-feedback')

        $autor.value = ''
        $autor_id.value = ''

        $.ajax({
            type: "POST",
            url: "../ajax/libro.php?op=buscar_autor",
            data: {
                cod_autor
            },
            success: function(response) {
                var resultado = JSON.parse(response);

                if (resultado == null) {
                    $feedback.innerText = 'Autor no existe'
                } else {
                    $autor.value = resultado.nombre;
                    $autor_id.value = resultado.id;
                    $feedback.innerText = ''
                }
            }
        });
    }
</script>
</body>

</html>
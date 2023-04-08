<?php
$title = 'Préstamo';
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
            <label for="cedula">Cédula:</label>
            <div class="d-flex flex-row justify-content-between">
                <div class="pr-md-2">
                    <input class="form-control" type="text" id="cedula" name="cedula" onblur="buscarEstudiante()">
                    <input type="hidden" name="estudianteId" id="estudianteId">
                    <small class="text-danger" id="cedula-feedback"></small>
                </div>

                <div class="">
                    <button class="float-right btn btn-primary" id="listar-estudiantes" onclick="listarEstudiantes()">Buscar</button>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="nombreEstudiante">Nombre:</label>
            <input class="form-control" type="text" id="nombreEstudiante" name="nombreEstudiante" readonly>
        </div>
        <div class="col-sm-3">
            <label for="fechaEstudiante">Fecha:</label>
            <input class="form-control" type="date" id="fechaEstudiante" name="fechaEstudiante">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label for="cod_libro">Código Libro:</label>
            <div class="d-flex flex-row justify-content-between">
                <div class="pr-md-2">
                    <input class="form-control" type="text" id="cod_libro" name="cod_libro" onblur="buscarLibro()">
                    <input type="hidden" name="libro_id" id="libro_id">
                    <small class="text-danger" id="libro-feedback"></small>
                </div>

                <div class="">
                    <button class="float-right btn btn-primary" id="listar-libros" onclick="listarLibros()">Buscar</button>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="titulo">Título:</label>
            <input class="form-control" type="text" id="titulo" name="titulo" readonly>
        </div>
        <div class="col-sm-3">
            <label for="fechaLibro">Fecha:</label>
            <input class="form-control" type="date" id="fechaLibro" name="fechaLibro">
        </div>
    </div>
    <div class="row p-3">
        <input type="hidden" id="prestamoId" name="prestamoId">
        <input type="hidden" id="detalleId" name="detalleId">
        <button type="button" class="col mr-1 btn btn-success" id="Agregar" onclick="agregar()">Agregar</button>
        <button type="button" class="col mr-1 btn btn-primary" id="Listar" onclick="listarPrestamos()">Buscar</button>
        <button type="button" class="col mr-1 btn btn-warning" id="Editar" onclick="edit()" disabled>Editar</button>
        <button type="button" class="col mr-1 btn btn-danger" id="Eliminar" onclick="delete()" disabled>Eliminar</button>
        <button type="button" class="col mr-1 btn btn-secondary" id="Limpiar" onclick="limpiar()">Limpiar</button>
    </div>
</div>

<div class="mb-3 card p-3" id="listadoregistros">
    <div class="row table-responsive pl-3 d-none" id="listaPrestamos">
        <table id="tbllistadoPrestamos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Id</th>
                <th>Cédula</th>
                <th>Estudiante</th>
                <th>Título</th>
                <th>Fecha</th>
                <th>Opciones</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th>Id</th>
                <th>Cédula</th>
                <th>Estudiante</th>
                <th>Título</th>
                <th>Fecha</th>
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

    <div class="row table-responsive pl-3" id="listaEstudiantes">
        <table id="tbllistadoEstudiantes" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Opciones</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Teléfono</th>
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
        var cod_libro = $("#cod_libro").val();
        var titulo = $("#titulo").val().trim();
        var cedula = $("#cedula").val();
        var nombreEstudiante = $("#nombreEstudiante").val().trim();
        var fechaLibro = $("#fechaLibro").val();
        var fechaEstudiante = $("#fechaEstudiante").val();

        if (cod_libro == '' || titulo == '' || cedula == '' || nombreEstudiante == '' || fechaLibro == '' || fechaEstudiante == '') {
            Swal.fire('Faltan Datos');
        } else {
            $.ajax({
                type: "POST",
                url: "../ajax/prestamo.php?op=guardar",
                data: {
                    cod_libro,
                    titulo,
                    cedula,
                    nombreEstudiante,
                    fechaLibro,
                    fechaEstudiante
                },
                success: function(response) {
                    Swal.fire(response);
                    limpiar();
                    listarLibros();
                }
            });
        }
    }

    function delete() {
        var id = $("#prestamoId").val();

        $.ajax({
            type: "POST",
            url: "../ajax/prestamo.php?op=eliminar",
            data: {
                id
            },
            success: function(response) {
                Swal.fire(response);
                limpiar();
                listarLibros();
            }
        });
    }

    function edit() {
        var id = $("#prestamoId").val();
        var detalleId = $("#detalleId").val();
        var cod_libro = $("#cod_libro").val();
        var titulo = $("#titulo").val().trim();
        var cedula = $("#cedula").val();
        var nombreEstudiante = $("#nombreEstudiante").val().trim();
        var fechaLibro = $("#fechaLibro").val();
        var fechaEstudiante = $("#fechaEstudiante").val();

        if (cod_libro == '' || titulo == '' || cedula == '' || nombreEstudiante == '' || fechaLibro == '' || fechaEstudiante == '') {
            Swal.fire('Faltan Datos');
        } else {
            $.ajax({
                type: "POST",
                url: "../ajax/prestamo.php?op=editar",
                data: {
                    id,
                    detalleId,
                    cod_libro,
                    titulo,
                    cedula,
                    nombreEstudiante,
                    fechaLibro,
                    fechaEstudiante
                },
                success: function(response) {
                    Swal.fire(response);
                }
            }).done(function() {
                listarLibros();
            });
        }
    }

    function buscarLibro() {
        var cod_libro = $("#cod_libro").val();
        var $feedback = document.getElementById('libro-feedback')

        $.ajax({
            type: "POST",
            url: "../ajax/libro.php?op=mostrar",
            data: {
                cod_libro
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                if (resultado == null) {
                    $feedback.innerText = 'Libro no existe'
                } else {
                    document.getElementById("titulo").value = resultado.titulo;
                    document.getElementById("libro_id").value = resultado.id;
                    $feedback.innerText = ''
                }

            }
        });
    }

    function show(id) {
        habilitar_botones();
        document.getElementById("listadoregistros").style.display = "none";
        $.ajax({
            type: "POST",
            url: "../ajax/prestamo.php?op=mostrar",
            data: {
                id
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                document.getElementById("fechaLibro").value = resultado['fechaLibro'];
                document.getElementById("fechaEstudiante").value = resultado['fechaEstudiante'];
                document.getElementById("cod_libro").value = resultado['codigo'];
                document.getElementById("cedula").value = resultado['cedula'];
                document.getElementById("prestamoId").value = resultado['idprestamo'];
                document.getElementById("detalleId").value = resultado['iddetalle'];
                $("#cod_libro").blur()
                $("#cedula").blur()
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
        document.getElementById("cedula").value = "";
        document.getElementById("estudianteId").value = "";
        document.getElementById("nombreEstudiante").value = "";
        document.getElementById("fecha").value = "";
        desabilitar_botones();
    }

    // Listar libros
    function listarLibros() {
        document.getElementById("listadoregistros").style.display = "block";
        document.getElementById("listaPrestamos").classList.add("d-none");
        document.getElementById("listaEstudiantes").classList.add("d-none");
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

    function selectLibro(cod_libro) {
        var $cod_libro = document.getElementById('cod_libro')
        var $titulo = document.getElementById('titulo')
        var $genero = document.getElementById('genero')
        var $feedback = document.getElementById('libro-feedback').innerText = ''

        desabilitar_botones();
        $.ajax({
            type: "POST",
            url: "../ajax/libro.php?op=mostrar",
            data: {
                cod_libro
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                console.log(resultado)
                $cod_libro.value = resultado.codigo;
                $titulo.value = resultado.titulo;
                $genero.value = resultado.genero;
            }
        });
    }

    function buscarEstudiante() {
        var cedula = document.getElementById('cedula').value
        var $nombreEstudiante = document.getElementById('nombreEstudiante')
        var $estudianteId = document.getElementById('estudianteId')
        var $feedback = document.getElementById('cedula-feedback')

        $nombreEstudiante.value = ''
        $estudianteId.value = ''

        $.ajax({
            type: "POST",
            url: "../ajax/estudiante.php?op=buscar",
            data: {
                cedula
            },
            success: function(response) {
                var resultado = JSON.parse(response);

                if (resultado == null) {
                    $feedback.innerText = 'Estudiante no existe'
                } else {
                    $nombreEstudiante.value = resultado.nombre;
                    $estudianteId.value = resultado.id;
                    $feedback.innerText = ''
                }
            }
        });
    }

    // Listar Estudiantes
    function listarEstudiantes() {
        document.getElementById("listadoregistros").style.display = "block";
        document.getElementById("listaEstudiantes").classList.remove("d-none");
        document.getElementById("listaLibros").classList.add("d-none");
        document.getElementById("listaPrestamos").classList.add("d-none");

        tabla = $('#tbllistadoEstudiantes').dataTable({
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
                url: "../ajax/estudiante.php?op=listar",
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

    function selectEstudiante(cedula) {
        var $nombreEstudiante = document.getElementById('nombreEstudiante')
        var $cedula = document.getElementById('cedula')
        var $feedback = document.getElementById('cedula-feedback').innerText = ''

        desabilitar_botones();
        $.ajax({
            type: "POST",
            url: "../ajax/estudiante.php?op=mostrar",
            data: {
                cedula
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                $nombreEstudiante.value = resultado.nombre;
                $cedula.value = resultado.cedula;
            }
        });
    }

    //Función Listar
    function listarPrestamos() {
        document.getElementById("listadoregistros").style.display = "block";
        document.getElementById("listaEstudiantes").classList.add("d-none");
        document.getElementById("listaLibros").classList.add("d-none");
        document.getElementById("listaPrestamos").classList.remove("d-none");

        tabla = $('#tbllistadoPrestamos').dataTable({
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
                url: "../ajax/prestamo.php?op=listar",
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
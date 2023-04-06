<?php
$title = 'Ingresar Datos';
ob_start();
?>

<style>

</style>

<h1 class="display-4">
    <?= $title ?>
</h1>

<div class="mb-3 card p-3">
    <div class="row">
        <div class="col-sm-3">
            <label for="cedula">Cedula:</label>
            <div class="d-flex flex-row justify-content-between">
                <div class="pr-md-2">
                    <input class="form-control" type="text" id="cedula" name="cedula" onblur="buscarEstudiante()">
                    <input type="hidden" name="estudianteId" id="estudianteId">
                    <small class="text-danger" id="cedula-feedback"></small>
                </div>

                <div class="">
                    <button class="float-right btn btn-secondary" id="listar-estudiantes" onclick="listarEstudiantes()">Buscar</button>
                </div>
            </div>
            <small id="cedula-feedback" class="text-danger"></small>
        </div>
        <div class="col-sm-3">
            <label for="nombreestudiante">Nombre:</label>
            <input type="text" class="form-control" id="nombreestudiante" />
            <input type="hidden" id="estudianteId">
            <small id="nombreestudiante-feedback" class="text-danger"></small>
        </div>
        <div class="col-sm-3">
            <label for="fechaboleta">Fecha:</label>
            <input type="date" class="form-control" id="fechaboleta" />
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label for="codigo">Código Libro:</label>
            <div class="d-flex flex-row justify-content-between">
                <div class="pr-md-2">
                    <input class="form-control input-libro" type="text" id="codigo" name="codigo" onblur="buscarLibro()" disabled>
                    <input type="hidden" class="input-libro" name="libroId" id="libroId" disabled>
                    <small class="text-danger" id="codigo-feedback"></small>
                </div>

                <div class="">
                    <button class="float-right btn btn-secondary input-libro" id="listar-libros" onclick="listarLibros()" disabled>Buscar</button>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="nombre">Nombre:</label>
            <input class="form-control input-libro" type="text" id="nombre" name="nombre" disabled>
        </div>
        <div class="col-sm-3">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control input-libro" id="fecha" disabled />
            <small id="fecha_feedback" class="text-danger"></small>
        </div>
        <button onclick="agregarFila()" id="agregarFila" class="btn btn-success input-libro" disabled>Agregar</button>

    </div>

    <br>

    <div class="table-responsive pl-3" id="listaDatos">
        <h2>Datos</h2>
        <table id="tabla" class="table">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="m-0 px-0 py-2">
                        <button onclick="guardarDatos()" class="btn btn-primary">Guardar</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="row table-responsive pl-3 d-none" id="listaLibros">
        <h2>Libros</h2>
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

    <div class="row table-responsive pl-3 d-none" id="listaEstudiantes">
        <h2>Estudiantes</h2>
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



    <table id="tbllistadoEstudiantes" class="d-none table table-striped table-bordered table-condensed table-hover">
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


<?php
$content = ob_get_clean();
include './includes/layout.php';
?>

<script>
    // Crear una variable global para el DataTable
    var tabla;

    $(document).ready(function() {
        // Crear el DataTable con columnas adicionales para los botones de eliminar y editar
        tabla = $('#tabla').DataTable({
            "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": "<button class='btn btn-sm btn-warning' onclick='editarFila(this)'>Editar</button> <button onclick='eliminarFila(this)' class='btn btn-sm btn-danger'>Eliminar</button>"
            }]
        });
    });

    function agregarFila() {
        $('.table-responsive').addClass('d-none')

        document.getElementById("listaDatos").classList.remove("d-none");

        // Obtener los valores de los cuadros de texto
        var codigo = $('#codigo').val();
        var nombre = $('#nombre').val();
        var fecha = $('#fecha').val();

        // Validar que los campos de texto no estén vacíos
        if (codigo === '' || nombre === '' || fecha === '') {
            alert('Todos los campos son obligatorios.');
            return;
        }

        // Agregar la fila al DataTable
        tabla.row.add([codigo, nombre, fecha]).draw();

        // Limpiar los valores de los cuadros de texto
        $('#codigo').val('');
        $('#nombre').val('');
        $('#fecha').val('');
    }

    function eliminarFila(btn) {
        // Obtener la fila que contiene el botón
        var fila = $(btn).closest('tr');

        // Eliminar la fila del DataTable
        tabla.row(fila).remove().draw();
    }

    function editarFila(btn) {

        // Obtener la fila que contiene el botón
        var fila = $(btn).closest('tr');

        // Obtener los valores de la fila
        var codigo = tabla.cell(fila, 0).data();
        var nombre = tabla.cell(fila, 1).data();
        var fecha = tabla.cell(fila, 2).data();

        //Mostramos los valores en las cajas de texto
        $('#codigo').val(codigo);
        $('#nombre').val(nombre);
        $('#fecha').val(fecha);

        // Eliminar la fila del DataTable
        tabla.row(fila).remove().draw();

    }

    function guardarDatos() {
        // Obtener los datos del DataTable y convertirlos en un objeto JSON
        var cedula = $("#cedula").val();
        var nombreestudiante = $("#nombreestudiante").val();
        var fecha = $("#fechaboleta").val();
        var detalle = tabla.rows().data().toArray();

        if (cedula == "" || nombreestudiante == "" || fecha == "" || detalle.length == 0) {
            Swal.fire('Faltan Datos');
            return
        }

        var encabezado = {
            "cedula": cedula,
            "nombre": nombreestudiante,
            "fecha": fecha
        }

        // Enviar los datos a un archivo PHP utilizando AJAX
        $.ajax({
            url: '../ajax/datos.php',
            type: 'POST',
            data: {
                encabezado: encabezado,
                detalle: JSON.stringify(detalle)
            },
            dataType: 'json',
            success: function(response) {},
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Datos Insertados");
                tabla.clear().draw();
            }
        });
    }

    function buscarLibro() {
        var codigo = $("#codigo").val();
        var $feedback = document.getElementById('codigo-feedback')

        if (codigo == "") {
            $feedback.innerText = ''
            $('#nombre').val('')
            return
        }

        $.ajax({
            type: "POST",
            url: "../ajax/libro.php?op=mostrar",
            data: {
                cod_libro: codigo
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                console.log(resultado)
                if (resultado == null) {
                    $feedback.innerText = 'Libro no existe'
                } else {
                    document.getElementById("nombre").value = resultado.titulo;
                    document.getElementById("libroId").value = resultado.id;
                    $feedback.innerText = ''
                }

            }
        });
    }

    function mostrar(id) {
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
                document.getElementById("codigo").value = resultado['codigo'];
                document.getElementById("cedula").value = resultado['cedula'];
                document.getElementById("prestamoId").value = resultado['idprestamo'];
                document.getElementById("detalleId").value = resultado['iddetalle'];
                $("#codigo").blur()
                $("#cedula").blur()
            }
        });
    }

    // Listar libros
    function listarLibros() {
        $('.table-responsive').addClass('d-none')

        document.getElementById("listaLibros").classList.remove("d-none");

        $('#tbllistado').dataTable({
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

    function selectLibro(codigo) {
        var $codigo = document.getElementById('codigo')
        var $nombre = document.getElementById('nombre')
        var $feedback = document.getElementById('codigo-feedback').innerText = ''


        $.ajax({
            type: "POST",
            url: "../ajax/libro.php?op=mostrar",
            data: {
                cod_libro: codigo
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                console.log(resultado)
                $codigo.value = resultado.codigo;
                $nombre.value = resultado.titulo;
            }
        });
    }

    function buscarEstudiante() {
        var cedula = document.getElementById('cedula').value
        var $nombreestudiante = document.getElementById('nombreestudiante')
        var $estudianteId = document.getElementById('estudianteId')
        var $feedback = document.getElementById('cedula-feedback')

        $nombreestudiante.value = ''
        $estudianteId.value = ''

        if (cedula == "") {
            $feedback.innerText = ''
            return
        }

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
                    desactivarRowLibro();
                } else {
                    $nombreestudiante.value = resultado.nombre;
                    $estudianteId.value = resultado.id;
                    $feedback.innerText = ''
                    activarRowLibro();
                }
            }
        });
    }

    // Listar Estudiantes
    function listarEstudiantes() {
        $('.table-responsive').addClass('d-none')

        document.getElementById("listaEstudiantes").classList.remove("d-none");

        $('#tbllistadoEstudiantes').dataTable({
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
        var $nombreestudiante = document.getElementById('nombreestudiante')
        var $cedula = document.getElementById('cedula')
        var $feedback = document.getElementById('cedula-feedback').innerText = ''

        $.ajax({
            type: "POST",
            url: "../ajax/estudiante.php?op=mostrar",
            data: {
                cedula
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                $nombreestudiante.value = resultado.nombre;
                $cedula.value = resultado.cedula;
                activarRowLibro()
            }
        });
    }

    function activarRowLibro() {
        $('#codigo').prop('disabled', false)
        $('#nombre').prop('disabled', false)
        $('#fecha').prop('disabled', false)
        $('#agregarFila').prop('disabled', false)
        $('#listar-libros').prop('disabled', false)
    }

    function desactivarRowLibro() {
        $('#codigo').prop('disabled', true)
        $('#nombre').prop('disabled', true)
        $('#fecha').prop('disabled', true)
        $('#agregarFila').prop('disabled', true)
        $('#listar-libros').prop('disabled', true)
    }
</script>

</body>

</html>
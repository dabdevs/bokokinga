<?php
$title = 'Colecciones';
ob_start();
?>

<style>
    #dataList {
        display: none;
    }
</style>

<!-- Categoría Modal -->
<div class="modal" id="cat-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="eliminar-body">
                ¿Seguro deseas eliminar la categoría?
            </div>

            <!-- Modal footer -->
            <div class="modal-footer" id="eliminar-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-chevron-left"></i> Salir</button>
                <button type="button" class="btn btn-danger" onclick="eliminate()"><i class="fa fa-trash"></i> Eliminar</button>
            </div>

            <input type="hidden" id="modal-categoria-id">
        </div>
    </div>
</div>
<!-- Categoría Modal End -->

<h1 class="display-4"><?= $title ?></h1>

<div class="mb-3 card p-3 d-none" id="top-form">
    <form action="" id="category-form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
                <label for="category_name">Nombre:</label>
                <input class="form-control" type="text" id="category_name" name="name">
            </div>

            <div class="col-sm-3">
                <label for="image">Imagen:</label>
                <input class="form-control" type="file" accept=”image/*” name="image" id="image">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 my-2">
                <label for="description">Descripción:</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                <input type="hidden" id="nuevo">
                <input type="hidden" id="category_id" name="id">
            </div>
        </div>

        <div class="row p-3">
            <button type="submit" class="col-sm-2 mr-1 btn btn-success" id="Guardar" disabled><i class="fa fa-save"></i> Guardar</button>
            <button type="button" class="col-sm-2 mr-1 btn btn-secondary" id="Cancelar" onclick="cancelar()"><i class="fa fa-times"></i> Cancelar</button>
        </div>
    </form>
</div>

<div class="mb-3 card p-3" id="dataList">
    <div class="row table-responsive pl-3">
        <button class="btn btn-success my-3 float-right" onclick="agregar()"><i class="fa fa-plus"></i> Agregar</button>

        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Opciones</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
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
    list();

    function habilitar_botones() {
        document.getElementById("Cancelar").disabled = false;
        document.getElementById("Guardar").disabled = false;
    }

    function desabilitar_botones() {
        document.getElementById("Cancelar").disabled = true;
        document.getElementById("Guardar").disabled = true;
    }

    function agregar() {
        $("#top-form").removeClass('d-none');
        document.getElementById("dataList").style.display = "none";
        habilitar_botones()
        $("#category_id").val("")
        $("#category_name").val("")
        $("#nuevo").val(1)
    }

    function showModal(id) {
        if (id == 0) {
            $('#modal-title').hide()
            $('#eliminar-body').hide()
            $('#eliminar-footer').hide()
            $('#modal-title-eliminar').hide()
        } else {
            $('#modal-categoria-id').val(id)
            $('#modal-title').show()
            $('#eliminar-body').show()
            $('#eliminar-footer').show()
            $('#modal-title-eliminar').show()
        }

        $('#cat-modal').modal('show')
    }

    function eliminate() {
        id = $('#modal-categoria-id').val()

        $.ajax({
            type: "POST",
            url: "../ajax/collection.php?op=delete",
            data: {
                id: id
            },
            success: function(response) {
                Swal.fire(response);
                cancelar();
            }
        })
        $('#cat-modal').modal('hide')
        list();
    }
    $("#category-form").on("submit", (e) => {
        e.preventDefault();
        var formData = new FormData(e.target);
        var nuevo = $("#nuevo").val();
        var url = nuevo == 1 ? "../ajax/collection.php?op=save" : "../ajax/collection.php?op=edit";

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#response').html(response);
            }
        });

        cancelar();
    })

    function edit(id) {
        habilitar_botones();
        document.getElementById("dataList").style.display = "none";
        $("#top-form").removeClass('d-none');
        $("#nuevo").val(0)
        $("#category_id").val(id)

        $.ajax({
            type: "POST",
            url: "../ajax/collection.php?op=show",
            data: {
                id
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                document.getElementById("category_name").value = resultado['name'];
                document.getElementById("description").value = resultado['description'];
            }
        });
    }

    function cancelar() {
        document.getElementById("category_name").value = "";
        document.getElementById("description").value = "";
        document.getElementById("image").value = "";
        desabilitar_botones();
        list()
    }

    // List categories
    function list() {
        document.getElementById("dataList").style.display = "block";
        $("#top-form").addClass('d-none');

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
                url: "../ajax/collection.php?op=list",
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
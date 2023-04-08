<?php
$title = 'Configuraciones';
ob_start();
?>

<style>
    #dataList {
        display: none;
    }
</style>

<!-- Configuraciones Modal -->
<div class="modal" id="configuration-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="eliminar-body">
                ¿Seguro deseas eliminar la configuración?
            </div>

            <!-- Modal footer -->
            <div class="modal-footer" id="eliminar-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-chevron-left"></i> Salir</button>
                <button type="button" class="btn btn-danger" onclick="eliminate()"><i class="fa fa-trash"></i> Eliminar</button>
            </div>

            <input type="hidden" id="modal-configurations-id">
        </div>
    </div>
</div>
<!-- Configuraciones Modal End -->

<h1 class="display-4"><?= $title ?></h1>

<div class="mb-3 card p-3 d-none" id="top-form">
    <form action="" id="configuration-form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
                <label for="configuration_name">Nombre:</label>
                <input class="form-control" type="text" id="configuration_name" name="name">
            </div>

            <div class="col-sm-6">
                <label for="configuration_value">Valor:</label>
                <input class="form-control" type="text" id="configuration_value" name="value">
                <input type="hidden" id="nuevo">
                <input type="hidden" id="configuration_id" name="id">
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
                <th>Valor</th>
                <th>Opciones</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th>Nombre</th>
                <th>Valor</th>
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
        $("#configuration_id").val("")
        $("#configuration_name").val("")
        $("#nuevo").val(1)
    }

    function showModal(id) {
        if (id == 0) {
            $('#modal-title').hide()
            $('#eliminar-body').hide()
            $('#eliminar-footer').hide()
            $('#modal-title-eliminar').hide()
        } else {
            $('#modal-configurations-id').val(id)
            $('#modal-title').show()
            $('#eliminar-body').show()
            $('#eliminar-footer').show()
            $('#modal-title-eliminar').show()
        }

        $('#configuration-modal').modal('show')
    }

    function eliminate() {
        id = $('#modal-configurations-id').val()

        $.ajax({
            type: "POST",
            url: "../ajax/configuration.php?op=delete",
            data: {
                id: id
            },
            success: function(response) {
                Swal.fire(response);
                cancelar();
            }
        })
        $('#configuration-modal').modal('hide')
        list();
    }
    $("#configuration-form").on("submit", (e) => {
        e.preventDefault();
        var formData = new FormData(e.target);
        var nuevo = $("#nuevo").val();
        var url = nuevo == 1 ? "../ajax/configuration.php?op=save" : "../ajax/configuration.php?op=edit";

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
        $("#configuration_id").val(id)

        $.ajax({
            type: "POST",
            url: "../ajax/configuration.php?op=show",
            data: {
                id
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                document.getElementById("configuration_name").value = resultado['name'];
                document.getElementById("configuration_value").value = resultado['value'];
            }
        });
    }

    function cancelar() {
        document.getElementById("configuration_name").value = "";
        document.getElementById("configuration_value").value = "";
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
                url: "../ajax/configuration.php?op=list",
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
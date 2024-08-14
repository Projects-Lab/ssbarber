function listarCategorias() {
    $('#categoriaProducto').empty();
    $.ajax({
        type: "POST",
        url: "controladores/categoria.controlador.php",
        data: {
            metodo: "categoria_select"
        },
        dataType: "json",
        success: function (response) {
            let option = "<option value='0' disabled>Seleccione</option>";
            response.forEach(element => {
                option += `<option value='${element.id}'>${element.nombre}</option>`;
            });
            $('#categoriaProducto').append(option);
        }
    });
}

function registrarProducto() {
    $.ajax({
        type: "POST",
        url: "controladores/productos.controlador.php",
        data: {
            metodo: "agregar_producto",
            data: $("#formAgregarProducto").serialize()
        },
        dataType: 'JSON',
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (response) {
            if (response.respuesta) {
                $('#modalAgregarProducto').modal('hide');
                $("#formAgregarProducto")[0].reset();
                $('#tbProductos').DataTable().ajax.reload(null, false);
                Swal.fire({
                    position: 'top-end',
                    title: 'Mensaje',
                    text: "Producto registrado!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    });
    return false;
}

function ListarProductos() {
    $('#tbProductos').dataTable({
        "bProcessing": true,
        "serverSide": false,
        "responsive": true,
        "lengthChange": true,
        "pageLength": 100,
        "bFilter": true,
        paging: true,
        searching: true,
        ajax: {
            url: 'controladores/productos.controlador.php',
            type: 'POST',
            data: { 'metodo': 'listar_productos' }
        },
        "bPaginate": true,
        "language": {
            url: "src/js/datatable_traduccion.json",
        },
        "aoColumns": [
            { mData: 'nombre' },
            { mData: 'codigo' },
            { mData: 'categoria' },
            { mData: 'stock' },
            { mData: 'precio' },
            { mData: 'op' }
        ],
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            {
                text: 'Actualizar',
                action: function (e, dt, node, config) {
                    dt.ajax.reload();
                }
            }
        ],
    });
}

function VerProducto(id) {
    $.ajax({
        type: "POST",
        url: "controladores/productos.controlador.php",
        data: {
            metodo: "consultar_producto",
            id_producto: id
        },
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (data) {
            var producto = JSON.parse(data);
            document.getElementById("idProducto_ver").value = producto.id;
            document.getElementById("verNombreProducto").value = producto.nombre;
            document.getElementById("verCodigoProducto").value = producto.codigo;
            document.getElementById("verCategoriaProducto").value = producto.categoria;
            document.getElementById("verStockProducto").value = producto.stock;
            document.getElementById("verPrecioProducto").value = producto.precio;

            $("#modalVerProducto").modal("show");
        }
    });
}

function EditarProducto(id) {
    $.ajax({
        type: "POST",
        url: "controladores/productos.controlador.php",
        data: {
            metodo: "editar_producto",
            id_producto: id
        },
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (data) {
            var producto = JSON.parse(data);
            document.getElementById("id_producto_editar").value = producto.id;
            document.getElementById("editarNombreProducto").value = producto.nombre;
            document.getElementById("editarCodigoProducto").value = producto.codigo;
            document.getElementById("editarCategoriaProducto").value = producto.categoria;
            document.getElementById("editarStockProducto").value = producto.stock;
            document.getElementById("editarPrecioProducto").value = producto.precio;

            $("#modalEditarProducto").modal("show");
        }
    });
}

function ActualizarProducto() {
    $.ajax({
        type: "POST",
        url: "controladores/productos.controlador.php",
        data: {
            metodo: "actualizar_producto",
            data: $("#frmEditarProducto").serialize()
        },
        dataType: 'JSON',
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (response) {
            if (response.respuesta) {
                $('#modal_editar_producto').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    title: 'Mensaje',
                    text: "Producto actualizado!",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#tbListarProducto').DataTable().ajax.reload(null, false);
                        Swal.close();
                        $("#frmEditarProducto")[0].reset();
                    }
                });
            }
        }
    });
    return false;
}

function EliminarProducto(id) {
    Swal.fire({
        title: "Desea eliminar este producto?",
        text: "La acción será irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "controladores/productos.controlador.php",
                data: {
                    metodo: "eliminar_producto",
                    id: id
                },
                dataType: "json",
                beforeSend: function () { $('body').LoadingOverlay("show"); },
                complete: function () { $('body').LoadingOverlay("hide"); },
                error: function () { $('body').LoadingOverlay("hide"); },
                success: function (response) {
                    if (response.respuesta) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Producto eliminado',
                            showConfirmButton: false,
                            timer: 1800
                        });
                        $('#tbListarProducto').DataTable().ajax.reload(null, false);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "No se puede eliminar el producto.",
                        });
                    }
                }
            });
        }
    });
}

function validar_existencia_producto(codigo_producto) {
    return $.ajax({
        type: "POST",
        url: "controladores/productos.controlador.php",
        data: {
            metodo: "validar_existencia_producto",
            codigo: codigo_producto,
        },
        dataType: "json",
    });
}

function validarCodigoProducto(event) {
    const codigo = event.target.value;

    const btnGuardar = document.getElementById("btnGuardar");

    if (codigo == "") {
        return false;
    }

    validar_existencia_producto(codigo)
        .done(function (response) {
            if (response.respuesta) {
                Swal.fire({
                    icon: "error",
                    title: "Producto Existe",
                    text: "Producto ya está registrado.",
                });
                btnGuardar.disabled = true;
            } else {
                Swal.fire({
                    icon: "success",
                    title: "Producto No existe",
                    text: "Puede registrarlo.",
                });
                btnGuardar.disabled = false;
            }
        })
        .fail(function () {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Error al realizar la consulta de validación.",
            });
        });
}

document.addEventListener("DOMContentLoaded", () => {
    listarCategorias();
    ListarProductos();

    const inputCodigo = document.getElementById("codigoProducto");

    inputCodigo.addEventListener("focusout", validarCodigoProducto);
});

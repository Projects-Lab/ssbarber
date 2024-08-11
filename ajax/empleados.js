// Registrar empleado
function registrarEmpleado() {
    $.ajax({
        type: "POST",
        url: "controladores/empleado.controlador.php",
        data: ({
            metodo: "agregar_empleado",
            data: $("#frmAgregarEmpleado").serialize()
        }),
        dataType: 'JSON',
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (response) {
            if (response.respuesta) {
                $('#modal_agregar_empleado').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    title: 'Mensaje',
                    text: "Empleado registrado!",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                        $("#frmAgregarEmpleado")[0].reset();
                        $('#tbListarEmpleados').DataTable().ajax.reload(null, false);
                    }
                })
            }
        }
    });
    return false;
}

// Listar empleados
function listarEmpleados() {
    $('#tabla_empleados').dataTable({
        "bProcessing": true,
        "serverSide": false,
        "responsive": true,
        "lengthChange": true,
        "pageLength": 100,
        "bFilter": true,
        paging: true,
        searching: true,
        ajax: {
            url: "controladores/empleado.controlador.php",
            type: 'POST',
            data: { 'metodo': 'listar_empleados' }
        },
        "bPaginate": true,
        "language": {
            url: "src/js/datatable_traduccion.json",
        },
        "aoColumns": [
            { mData: 'nombre' },
            { mData: 'cargo' },
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

// Ver detalles de empleado
// function verEmpleado(id) {
//     $.ajax({
//         type: "POST",
//         url: "controladores/empleado.controlador.php",
//         data: ({
//             metodo: "consultar_empleado",
//             id_empleado: id
//         }),
//         beforeSend: function () { $('body').LoadingOverlay("show"); },
//         complete: function () { $('body').LoadingOverlay("hide"); },
//         error: function () { $('body').LoadingOverlay("hide"); },
//         success: function (data) {
//             var empleado = JSON.parse(data)

//             document.getElementById("nombreEmpleado_ver").value = empleado.nombre;
//             document.getElementById("cargoEmpleado_ver").value = empleado.cargo;

//             $("#modal_ver_empleado").modal("show");
//         }
//     });
// }

// Editar empleado
function editarEmpleado(id) {
    $.ajax({
        type: "POST",
        url: "controladores/empleado.controlador.php",
        data: ({
            metodo: "editar_empleado",
            id_empleado: id
        }),
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (data) {
            var empleado = JSON.parse(data)

            document.getElementById("idEmpleadoEditar").value = empleado.id;
            document.getElementById("nombreEmpleadoEditar").value = empleado.nombre;
            document.getElementById("cargoEmpleadoEditar").value = empleado.cargo_id;

            $("#modal_editar_empleado").modal("show");
        }
    });
}

// Actualizar empleado
function actualizarEmpleado() {
    $.ajax({
        type: "POST",
        url: "controladores/empleado.controlador.php",
        data: ({
            metodo: "actualizar_empleado",
            data: $("#frmEditarEmpleado").serialize()
        }),
        dataType: 'JSON',
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (response) {
            if (response.respuesta) {
                $('#modal_editar_empleado').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    title: 'Mensaje',
                    text: "Empleado actualizado!",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#tbListarEmpleados').DataTable().ajax.reload(null, false);
                        Swal.close();
                        $("#frmEditarEmpleado")[0].reset();
                    }
                })
            }
        }
    });
    return false;
}

// Eliminar empleado
function eliminarEmpleado(id) {
    Swal.fire({
        title: "Desea eliminar este empleado?",
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
                url: "controladores/empleado.controlador.php",
                data: ({
                    metodo: "eliminar_empleado",
                    id: id
                }),
                dataType: "json",
                beforeSend: function () { $('body').LoadingOverlay("show"); },
                complete: function () { $('body').LoadingOverlay("hide"); },
                error: function () { $('body').LoadingOverlay("hide"); },
                success: function (response) {
                    if (response.respuesta) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Empleado eliminado',
                            showConfirmButton: false,
                            timer: 1800
                        });
                        $('#tbListarEmpleados').DataTable().ajax.reload(null, false);
                    } else {
                        alert("No se puede eliminar");
                    }
                }
            });
        }
    })
}

document.addEventListener("DOMContentLoaded", () => {
    listarEmpleados();
});
function listar() {
    var table = $('#tbUsuarios').dataTable({
        "bProcessing": true,
        "serverSide": false,
        "responsive": true,
        "lengthChange": false,
        "pageLength": 100,
        "bFilter": true,
        order: [[1, 'asc']],
        ajax: {
            url: 'controladores/usuario.controlador.php',
            type: 'POST',
            data: { 'metodo': 'listar' }
        },
        "bPaginate": true,
        "language": {
            url: "src/js/datatable_traduccion.json",
        },
        "aoColumns": [
            { mData: 'NOMBRE' },
            { mData: 'USUARIO' },
            { mData: 'PERFIL' },
            {
                mData: 'ESTADO', render: function (data, type, row, meta) {
                    if(data == "A"){
                        return "Activo";
                    }else{
                        return "Inactivo";
                    }
                }
            },
            { mData: 'REGISTRO' },
            { mData: 'OP' }
        ]
    });
}

function insertar() {
    $.ajax({
        type: "POST",
        url: "controladores/usuario.controlador.php",
        data: {
            metodo: "insertar",
            data: $("#frmRegistrar").serialize(),
        },
        dataType: "json",
        success: function (data) {
            if (data.response) {
                $("#modalAgregarUsuario").modal("hide");
                Swal.fire({
                    title: "Mensaje",
                    text: "Usuario registrado correctamente!",
                    icon: "success",
                    confirmButtonText: "Ok",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                        $("#frmRegistrar")[0].reset();
                        $('#tbUsuarios').DataTable().ajax.reload(null, false);
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Advertencia",
                    text: "Error al insertar",
                });
            }
        },
    });
    return false;
}

function editar(id) {
    $.ajax({
        type: "POST",
        url: "controladores/usuario.controlador.php",
        data: {
            metodo: "editar",
            usuario_id: id
        },
        dataType: "json",
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (data) {
            $("#usuario_id").val(data.id);
            $("#nuevoNombre_u").val(data.nombre);
            $("#nuevoUsuario_u").val(data.usuario);
            $("#nuevoPerfil_u").val(data.perfil);
            $("#nuevoEstado_u").val(data.estado);

            $("#modalEditarUsuario").modal("show");
        },
    });
    return false;
}

function actualizar() {
    $.ajax({
        type: "POST",
        url: "controladores/usuario.controlador.php",
        data: {
            metodo: "actualizar",
            data: $("#frmActualizar").serialize(),
        },
        dataType: "json",
        success: function (data) {
            if (data.response) {
                $("#modalEditarUsuario").modal("hide");
                Swal.fire({
                    title: "Mensaje",
                    text: "Usuario actualizado correctamente!",
                    icon: "success",
                    confirmButtonText: "Ok",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                        $("#frmActualizar")[0].reset();
                        $('#tbUsuarios').DataTable().ajax.reload(null, false);
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Advertencia",
                    text: "Error al insertar",
                });
            }
        },
    });
    return false;
}

function eliminar(id) {
    Swal.fire({
        title: "Desea eliminar este usuario?",
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
                url: "controladores/usuario.controlador.php",
                data: ({
                    metodo: "eliminar",
                    usuario_id: id
                }),
                dataType: "json",
                beforeSend: function () { $('body').LoadingOverlay("show"); },
                complete: function () { $('body').LoadingOverlay("hide"); },
                error: function () { $('body').LoadingOverlay("hide"); },
                success: function (data) {
                    if (data.response) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Usuario eliminado',
                            showConfirmButton: false,
                            timer: 1800
                        });
                        $('#tbUsuarios').DataTable().ajax.reload(null, false);
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Error al intenter eliminar',
                            showConfirmButton: false,
                            timer: 1800
                        });
                    }
                }
            });
        }
    })
}

document.addEventListener("DOMContentLoaded", () => {
    listar();
});

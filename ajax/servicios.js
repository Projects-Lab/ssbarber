function listar() {
    $.ajax({
        type: "POST",
        url: "controladores/servicios.controlador.php", // Cambiado a servicios
        data: {
            metodo: "listar"
        },
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            let filas = '';
            respuesta.forEach(element => {
                filas += `<tr>
                                <td>${element.id}</td> 
                                <td>${element.nombre}</td> 
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="btn btn-secondary btn-sm"  onclick='editar(${element.id})'>
                                        <i class="fas fa-user-edit"></i>
                                      </button>
                                      <button class="btn btn-danger btn-sm" onclick='eliminar(${element.id})'>
                                        <i class="fas fa-trash"></i>
                                      </button> 
                                    </div>
                                </td> 
                                </tr>`;
            });
            $('#tservicios tbody').empty().append(filas);
            $('#tservicios').DataTable({
                processing: true,
                destroy: true,
            });
        }
    });
}

function insertar() {
    $.ajax({
        type: "POST",
        url: "controladores/servicios.controlador.php", // Cambiado a servicios
        data: {
            metodo: "insertar",
            data: $("#finsert").serialize()
        },
        dataType: "json",
        success: function (data) {
            if (data.respuesta) {
                $('#modalAgregarServicio').modal('hide');
                Swal.fire({
                    title: 'Mensaje',
                    text: "Datos insertados correctamente!",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                        $("#finsert")[0].reset();
                        location.href = location.href; 
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Advertencia',
                    text: 'Error al insertar'
                })
            }
        }
    });
    return false;
}

function editar(id) {
    $.ajax({
        type: "POST",
        url: "controladores/servicios.controlador.php", // Cambiado a servicios
        data: {
            metodo: "editar",
            id: id
        },
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            $('#idservicio').val(respuesta.id);
            $('#editarNombre').val(respuesta.nombre);
            $('#modalEditarServicio').modal('show');
        }
    });
}

function actualizar() {
    $.ajax({
        type: "POST",
        url: "controladores/servicios.controlador.php", // Cambiado a servicios
        data: {
            metodo: "actualizar",
            data: $("#fupdate").serialize()
        },
        dataType: "json",
        success: function (data) {
            if (data.respuesta) {
                $('#modalEditarServicio').modal('hide');
                Swal.fire({
                    title: 'Mensaje',
                    text: "Datos actualizados correctamente!",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                        $("#fupdate")[0].reset();
                        location.href = location.href;
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Advertencia',
                    text: 'Error al actualizar'
                })
            }
        }
    });
    return false;
}

function eliminar(id) {
    Swal.fire({
        title: '¿Estás seguro de eliminar este registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#007bff',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "controladores/servicios.controlador.php", // Cambiado a servicios
                data: {
                    metodo: "eliminar",
                    id: id
                },
                dataType: "json",
                success: function (respuesta) {
                    location.href = location.href;
                }
            });
        }
    })
}

document.addEventListener("DOMContentLoaded", () => {
    listar();
});

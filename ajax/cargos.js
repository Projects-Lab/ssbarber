function listar() {
    $.ajax({
        type: "POST",
        url: "controladores/cargo.controlador.php",
        data: ({
            metodo: "listar"
        }),
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
                                      <button class="btn btn-danger btn-sm" onclick='eliminar(${element.id})' > <i class="fas fa-trash"></i></button> 
                                    </div>
                                </td> 
                               
                                </tr>`;
            });
            $('#tcargos tbody').empty().append(filas)
            $('#tcargos').DataTable({
                processing: true,
                destroy: true,
            })

        }
    });
}


function insertar() {
    $.ajax({
        type: "POST",
        url: "controladores/cargo.controlador.php",
        data: {
            metodo: "insertar",
            data: $("#finsert").serialize()
        },
        dataType: "json",
        success: function (data) {
            if (data.respuesta) {
                $('#modalAgregarCargo').modal('hide');
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
        url: "controladores/cargo.controlador.php",
        data: {
            metodo: "editar",
            id: id
        },
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            $('#idcargo').val(respuesta.id);
            $('#editarNombre').val(respuesta.nombre);
            $('#modalEditarCargos').modal('show');
        }
    });
}

function actualizar() {
    $.ajax({
        type: "POST",
        url: "controladores/cargo.controlador.php",
        data: {
            metodo: "actualizar",
            data: $("#fupdate").serialize()

        },
        dataType: "json",
        success: function (data) {
            if (data.respuesta) {
                $('#modalEditarCargos').modal('hide');
                Swal.fire({
                    title: 'Mensaje',
                    text: "Datos ambulancia actualizados!",
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
                url: "controladores/cargo.controlador.php",
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
    listar()
});
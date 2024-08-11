function listarDepartamentos() {
    $.ajax({
        type: "POST",
        url: "controladores/aph.controlador.php",
        data: ({
            metodo: "listar_departamentos"
        }),
        dataType: "json",
        success: function (response) {
            let option = '';

            response.forEach(element => {
                option += `<option value=${element.id_departamento}>${element.departamento}</option>`;
            });

            $("#departamentoPaciente, #departamentoPaciente_editar").append(option);
        }
    });
}

function listarMunicipio(data) {

    var select = data.id;

    $.ajax({
        type: "POST",
        url: "controladores/aph.controlador.php",
        data: ({
            metodo: "listar_municipio", departamento: data.value
        }),
        dataType: "json",
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (response) {
            let option = '';

            response.forEach(element => {
                option += `<option value=${element.id_municipio}>${element.municipio}</option>`;
            });

            if (select == 'departamentoPaciente') {
                $("#municipioPaciente").empty().append(option);
            }

            if (select == 'departamentoPaciente_editar') {
                $("#municipioPaciente_editar").empty().append(option);
            }
        }
    });
}

function listarMunicipioEditar() {
    var id_departamento = document.getElementById('departamentoPaciente_editar').value
    $.ajax({
        type: "POST",
        url: "controladores/aph.controlador.php",
        data: ({
            metodo: "listar_municipio", departamento: id_departamento
        }),
        dataType: "json",
        success: function (response) {
            let option = '';

            response.forEach(element => {
                option += `<option value=${element.id_municipio}>${element.municipio}</option>`;
            });

            $("#municipioPaciente_editar").empty().append(option);
        }
    });
}

function listarTipoDocumento() {
    $.ajax({
        type: "POST",
        url: "controladores/pacientes.controlador.php",
        data: ({
            metodo: "tipo_documento"
        }),
        dataType: "json",
        success: function (response) {
            let option = '';

            response.forEach(element => {
                option += `<option value=${element.id}>${element.codigo} - ${element.descripcion}</option>`;
            });

            $("#tipoDocumentoPaciente, #tipoDocumentoPaciente_editar").append(option);
        },
        complete: () => {
            $('#tipoDocumentoPaciente option[value=2]').attr('selected', 'selected');
        }
    });
}

function ListarAseguradora() {
    $.ajax({
        type: "POST",
        url: "controladores/aph.controlador.php",
        data: ({
            metodo: "listar_aseguradora"
        }),
        dataType: "json",
        success: function (response) {
            let option = '';

            response.forEach(element => {
                option += `<option value=${element.id}>${element.nombre}</option>`;
            });

            $("#aseguradoraPaciente, #aseguradoraPaciente_editar").empty().append(option);
        }
    });
}

function agregarAseguradora() {
    $.ajax({
        type: "POST",
        url: "controladores/aph.controlador.php",
        data: ({
            metodo: "agregar_aseguradora", nombreAseguradora: document.getElementById('aseguradoraNombre').value
        }),
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function () {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Datos guardados',
                showConfirmButton: false,
                timer: 1500
            })
            ListarAseguradora();
            $('#modalAgregarAseguradora').modal('hide');
        }
    });
    return false;
}

function agregarEps() {
    $.ajax({
        type: "POST",
        url: "controladores/eps.controlador.php",
        data: ({
            metodo: "insertar",
            data: $("#frmAgregarEps").serialize()
        }),
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (data) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Datos guardados',
                showConfirmButton: false,
                timer: 500
            })
            ListarEps();
            $("#frmAgregarEps")[0].reset();
            $('#modalAgregarEps').modal('hide');
            $("#epsPaciente").focus();
        }
    });
    return false;
}

function ListarEps() {
    $.ajax({
        type: "POST",
        url: "controladores/eps.controlador.php",
        data: ({
            metodo: "listar"
        }),
        dataType: "json",
        success: function (response) {
            let option = '';

            response.forEach(element => {
                option += `<option value=${element.id}>${element.nombre}</option>`;
            });

            $("#epsPaciente, #epsPaciente_editar").empty().append(option);
        }
    });
}

function registrarPaciente() {
    $.ajax({
        type: "POST",
        url: "controladores/aph.controlador.php",
        data: ({
            metodo: "agregar_paciente",
            data: $("#frmAgregarPaciente").serialize()
        }),
        dataType: 'JSON',
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (response) {
            if (response.respuesta) {
                $('#modal_agregar_paciente').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    title: 'Mensaje',
                    text: "Datos registrados!",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                        $("#frmAgregarPaciente")[0].reset();
                        $('#tbListarPaciente').DataTable().ajax.reload(null, false);
                    }
                })
            }
        }
    });
    return false;
}

function ListarPacientes() {
    $('#tbListarPaciente').dataTable({
        "bProcessing": true,
        "serverSide": false,
        "responsive": true,
        "lengthChange": true,
        "pageLength": 100,
        "bFilter": true,
        paging: true,
        searching: true,
        ajax: {
            url: 'controladores/pacientes.controlador.php',
            type: 'POST',
            data: { 'metodo': 'listar_pacientes' }
        },
        "bPaginate": true,
        "language": {
            url: "src/js/datatable_traduccion.json",
        },
        "aoColumns": [
            { mData: 'nombres' },
            { mData: 'apellidos' },
            { mData: 'descripcion' },
            { mData: 'numero_identificacion' },
            { mData: 'telefonos' },
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

function VerPaciente(id) {
    $.ajax({
        type: "POST",
        url: "controladores/pacientes.controlador.php",
        data: ({
            metodo: "consultar_paciente",
            id_paciente: id
        }),
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (data) {
            var paciente = JSON.parse(data)

            document.getElementById("tipoDocumentoPaciente_ver").value = paciente.ti
            document.getElementById("identificacionPaciente_ver").value = paciente.numero
            document.getElementById("primerNombrePaciente_ver").value = paciente.primer_nombre
            document.getElementById("segundoNombrePaciente_ver").value = paciente.segundo_nombre
            document.getElementById("primerApellidoPaciente_ver").value = paciente.primer_apellido
            document.getElementById("segundoApellidoPaciente_ver").value = paciente.segundor_apellido
            document.getElementById("generoPaciente_ver").value = paciente.sexo
            document.getElementById("fechaNacimientoPaciente_ver").value = paciente.fecha_nacimiento
            document.getElementById("edadPaciente_ver").value = paciente.edad
            document.getElementById("estadoCivilPaciente_ver").value = paciente.estado_civil
            document.getElementById("pacienteOcupacion_ver").value = paciente.ocupacion

            document.getElementById("celularPaciente_ver").value = paciente.celular
            document.getElementById("telefonoPaciente_ver").value = paciente.telefono
            document.getElementById("acompanantePaciente_ver").value = paciente.responsable
            document.getElementById("parentezcoPaciente_ver").value = paciente.parentezco_responsable
            document.getElementById("telefonoAcompanante_ver").value = paciente.parentezco_telefono
            document.getElementById("avisarPaciente_ver").value = paciente.responsable_avisar
            document.getElementById("celularAvisar_ver").value = paciente.responsable_avisar_telefono

            document.getElementById("departamentoPaciente_ver").value = paciente.departamento_paciente
            document.getElementById("municipioPaciente_ver").value = paciente.municipio_paciente
            document.getElementById("direccionResidenciaPaciente_ver").value = paciente.direccion_residencia
            document.getElementById("zonaPaciente_ver").value = paciente.zona_ubicacion_paciente

            document.getElementById("aseguradoraPaciente_ver").value = paciente.asegurado_paciente
            document.getElementById("epsPaciente_ver").value = paciente.eps_paciente

            document.getElementById("alergiaPaciente_ver").value = paciente.antecedentes_alergia
            document.getElementById("patologicoPaciente_ver").value = paciente.antecedentes_patologico
            document.getElementById("medicacionPaciente_ver").value = paciente.antecedentes_medicacion
            document.getElementById("liquidosAlimentosPaciente_ver").value = paciente.antecedentes_liqali

            $("#modal_ver_paciente").modal("show")
        }
    });
}

function EditarPaciente(id) {
    $.ajax({
        type: "POST",
        url: "controladores/pacientes.controlador.php",
        data: ({
            metodo: "editar_paciente",
            id_paciente: id
        }),
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (data) {
            var paciente = JSON.parse(data)

            document.getElementById("id_paciente_editar").value = paciente.id

            document.getElementById("tipoDocumentoPaciente_editar").value = paciente.tipo_documento_id
            document.getElementById("identificacionPaciente_editar").value = paciente.numero_identificacion
            document.getElementById("primerNombrePaciente_editar").value = paciente.primer_nombre
            document.getElementById("segundoNombrePaciente_editar").value = paciente.segundo_nombre
            document.getElementById("primerApellidoPaciente_editar").value = paciente.primer_apellido
            document.getElementById("segundoApellidoPaciente_editar").value = paciente.segundo_apellido
            document.getElementById("generoPaciente_editar").value = paciente.sexo
            document.getElementById("fechaNacimientoPaciente_editar").value = paciente.fecha_nacimiento
            document.getElementById("edadPaciente_editar").value = paciente.edad
            document.getElementById("estadoCivilPaciente_editar").value = paciente.estado_civil
            document.getElementById("pacienteOcupacion_editar").value = paciente.ocupacion

            document.getElementById("celularPaciente_editar").value = paciente.telefono_1
            document.getElementById("telefonoPaciente_editar").value = paciente.telefono_2
            document.getElementById("acompanantePaciente_editar").value = paciente.responsable
            document.getElementById("parentezcoPaciente_editar").value = paciente.parentesco_responsable
            document.getElementById("telefonParentesco_editar").value = paciente.telefono_parentesco
            document.getElementById("avisarPaciente_editar").value = paciente.responsable_2
            document.getElementById("celularAvisar_editar").value = paciente.telefono_responsable_2

            document.getElementById("departamentoPaciente_editar").value = paciente.id_departamento
            listarMunicipioEditar();
            setTimeout(() => {
                document.getElementById("municipioPaciente_editar").value = paciente.id_municipio
            }, 500);

            document.getElementById("direccionResidenciaPaciente_editar").value = paciente.direccion_residencia
            document.getElementById("zonaPaciente_editar").value = paciente.zona_paciente

            document.getElementById("aseguradoraPaciente_editar").value = paciente.aseguradora_id
            document.getElementById("epsPaciente_editar").value = paciente.id_eps

            document.getElementById("alergiaPaciente_editar").value = paciente.antecedentes_alergia
            document.getElementById("patologicoPaciente_editar").value = paciente.antecedentes_patologico
            document.getElementById("medicacionPaciente_editar").value = paciente.antecedentes_medicacion
            document.getElementById("liquidosAlimentosPaciente_editar").value = paciente.antecedentes_liqali

            $("#modal_editar_paciente").modal("show")
        }
    });
}

function validar_existencia(numero_identificacion) {
  return $.ajax({
    type: "POST",
    url: "controladores/pacientes.controlador.php",
    data: {
      metodo: "validar_existencia",
      numero_identificacion: numero_identificacion,
    },
    dataType: "json",
  });
}

// Obtener el elemento de entrada
const inputIdentificacion = document.getElementById("identificacionPaciente");

// Agregar el evento 'focusout' al campo de entrada
inputIdentificacion.addEventListener("focusout", validarCedula);

// Función de validación
function validarCedula(event) {
  const cedula = event.target.value;
  const btnGuardar = document.getElementById("btnGuardar");

  // Realizar la consulta de validación utilizando la función anterior
  validar_existencia(cedula)
    .done(function (response) {
      if (response.respuesta) {
        Swal.fire({
          icon: "error",
          title: "Paciente Existe",
          text: "Paciente ya esta registrado.",
        });
        // Si la cédula existe, deshabilita el botón de guardar
        btnGuardar.disabled = true;
      } else {
        Swal.fire({
          icon: "success",
          title: "Paciente No existe, ",
          text: "Puede registrarlo.",
        });
        // Si la cédula no existe, habilita el botón de guardar
        btnGuardar.disabled = false;
      }
    })
    .fail(function () {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Error al realizar la consulta de validación.",
      });
      // Aquí puedes manejar el error en caso de que ocurra algún problema en la consulta
    });
}


function ActualizarPaciente() {
    $.ajax({
        type: "POST",
        url: "controladores/pacientes.controlador.php",
        data: ({
            metodo: "actualizar_paciente",
            data: $("#frmEditarPaciente").serialize()
        }),
        dataType: 'JSON',
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (response) {
            if (response.respuesta) {
                $('#modal_editar_paciente').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    title: 'Mensaje',
                    text: "Datos actualizados!",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#tbListarPaciente').DataTable().ajax.reload(null, false);
                        Swal.close();
                        $("#frmEditarPaciente")[0].reset();
                    }
                })
            }
        }
    });
    return false;
}

function EliminarPaciente(id) {
    Swal.fire({
        title: "Desea eliminar este paciente?",
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
                url: "controladores/pacientes.controlador.php",
                data: ({
                    metodo: "eliminar_paciente",
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
                            title: 'APH eliminado',
                            showConfirmButton: false,
                            timer: 1800
                        });
                        $('#tbListarPaciente').DataTable().ajax.reload(null, false);
                    } else {
                        alert("No se puede eliminar");
                    }
                }
            });
        }
    })
}

document.addEventListener("DOMContentLoaded", () => {
    ListarPacientes();
    listarTipoDocumento();
    ListarAseguradora();
    listarDepartamentos();
    ListarEps()
});

//OK

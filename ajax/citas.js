function listarCitas() {
  $.ajax({
    type: "POST",
    url: "controladores/citas.controlador.php",
    data: {
      metodo: "listar"
    },
    dataType: "json",
    success: function (respuesta) {
      //console.log(respuesta);
      let filas = '';
      respuesta.forEach(element => {
        filas += `<tr>
                              <td>${element.fecha_asignada}</td>
                              <td>${element.hora_asignada}</td>
                              <td>${element.nombre_completo} ${element.apellido_completo}</td>
                              <td>${element.nombre_empleado}</td>
                              <td>${element.nombre_servicio}</td>
                              <td class='text-center'>${element.estado == "P" ? `<button class="btn btn-warning btn-sm" onclick="atender_cita(${element.id})">PENDIENTE</button>` : '<span class="badge badge-success">ATENDIDO</span>'}</td>
                              <td>
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn btn-secondary btn-sm"  title='Editar' onclick='editarCita(${element.id})'>
                                      <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" title='Eliminar' onclick='eliminarCita(${element.id})' > <i class="fas fa-trash"></i></button> 
                                    <button class="btn btn-info btn-sm" title='Imprimir' onclick='imprimir(${element.id})' > <i class='fas fa-print'></i></button> 
                                  </div>
                              </td> 
                              </tr>`;
      });
      $('#tcitas tbody').empty().append(filas)
      $('#tcitas').DataTable({
        processing: true,
        destroy: true,
      })

    }
  });
}

function atender_cita(id) {
  Swal.fire({
    title: "Aviso",
    text: "Deseas indicar esta cita como Atendida?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, acepto",
    cancelButtonText: "No"
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "controladores/citas.controlador.php",
        data: {
          metodo: "atender_cita", id_cita: id
        },
        dataType: "json",
        success: function (data) {
          if (data.respuesta) {
            Swal.fire({
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success"
            });
            location.reload();
          }
        }
      });
    }
  });
}

function registrarCita() {
  $.ajax({
    type: "POST",
    url: "controladores/citas.controlador.php",
    data: {
      metodo: "insertar",
      data: $("#frmAgregarCita").serialize()
    },
    dataType: "json",
    success: function (data) {
      console.log(data);
      if (data.respuesta) {
        $('#modalAgregarCita').modal('hide');
        $("#frmAgregarCita")[0].reset();
        location.reload();
        Swal.fire({
          position: 'top-end',
          title: 'Mensaje',
          text: "Cita registrada correctamente!",
          icon: 'success',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Advertencia',
          text: 'Error al registrar la cita'
        })
      }
    }
  });
  return false;
}


function editarCita(id) {
  $.ajax({
    type: "POST",
    url: "controladores/citas.controlador.php",
    data: {
      metodo: "editar",
      id: id
    },
    dataType: "json",
    success: function (respuesta) {
      //console.log(respuesta);
      $('#idcita').val(respuesta.id);
      $('#fecha_cita').val(respuesta.fecha_asignada);
      $('#hora_cita').val(respuesta.hora_asignada);
      $('#id_cliente').val(respuesta.numero_identificacion);
      $('#nombre_cliente').val(respuesta.nombre_completo);
      $('#apellidos_cliente').val(respuesta.apellido_completo);
      $('#empleado').val(respuesta.nombre_empleado);
      $('#servicio').val(respuesta.nombre_servicio);
      $('#modalAgregarCita').modal('show');
    }
  });
}

function actualizarCita() {
  $.ajax({
    type: "POST",
    url: "controladores/citas.controlador.php",
    data: {
      metodo: "actualizar",
      data: $("#frmAgregarCita").serialize()
    },
    dataType: "json",
    success: function (data) {
      if (data.respuesta) {
        $('#modalAgregarCita').modal('hide');
        Swal.fire({
          title: 'Mensaje',
          text: "Cita actualizada correctamente!",
          icon: 'success',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.close();
            $("#frmAgregarCita")[0].reset();
            location.href = location.href;
          }
        })
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Advertencia',
          text: 'Error al actualizar la cita'
        })
      }
    }
  });
  return false;
}


function eliminarCita(id) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: "No podrás revertir esta acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "controladores/citas.controlador.php",
        data: {
          metodo: "eliminar",
          id: id
        },
        dataType: "json",
        success: function (respuesta) {
          if (respuesta) {
            Swal.fire({
              title: 'Mensaje',
              text: "Cita eliminada correctamente!",
              icon: 'success',
              confirmButtonText: 'Ok'
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.close();
                listarCitas();
              }
            })
          }
        }
      });
    }
  })
}


function imprimir(id) {
  $.ajax({
    type: "POST",
    url: "controladores/citas.controlador.php",
    data: {
      metodo: "imprimir",
      id: id
    },
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        console.log('respuesta')

      }


    }
  });


  if (id) {
    let timerInterval
    Swal.fire({
      title: 'Generando el PDF',
      html: 'Por favor espere: <b></b> milliseconds.',
      timer: 1000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
          b.textContent = Swal.getTimerLeft()
        }, 100)
      },
      willClose: () => {
        clearInterval(timerInterval)
      }
    }).then((result) => {
      if (result) {
        window.open('./pdf_citas.php');



      }
    })
  }
}

function listarServicios() {
  $("#servicio").empty();
  $.ajax({
    type: "POST",
    url: "controladores/citas.controlador.php",
    data: {
      metodo: "listar_servicios"
    },
    dataType: "json",
    success: function (response) {
      let option = "<option value='0' disabled>Seleccione</option>";
      response.forEach(element => {
        option += `<option value='${element.id}'>${element.nombre}</option>`;
      });
      $('#servicio').append(option);
    }
  });
}

function listarEmpleados() {
  $("#empleado").empty();
  $.ajax({
    type: "POST",
    url: "controladores/citas.controlador.php",
    data: {
      metodo: "listar_empleados"
    },
    dataType: "json",
    success: function (response) {
      let option = "<option value='0' disabled>Seleccione</option>";
      response.forEach(element => {
        option += `<option value='${element.id}'>${element.nombre}</option>`;
      });
      $('#empleado').append(option);
    }
  });
}

$(document).ready(function () {
  listarCitas();
  imprimir();
  listarServicios();
  listarEmpleados();

  $("#id_cliente").focusout(function () {
    if (this.value !== "") {
      $.ajax({
        type: "POST",
        url: "controladores/citas.controlador.php",
        data: {
          metodo: "consultar_cliente",
          numero: this.value
        },
        dataType: "json",
        success: function (data) {
          if (data !== false) {
            $("#codigo_cliente").val(data.id);
            $("#nombre_cliente").val(data.primer_nombre + " " + data.segundo_nombre);
            $("#apellidos_cliente").val(data.primer_apellido + " " + data.segundo_apellido);
          } else {
            alert("EL numero no existe");
            $("#id_cliente").val("");
            $("#id_cliente").focus();
          }
        }
      });
    }
  });
});

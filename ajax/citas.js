function listarCitas() {
  $.ajax({
    type: "POST",
    url: "controladores/citas.controlador.php",
    data: {
      metodo: "listar"
    },
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      let filas = '';
      respuesta.forEach(element => {
        filas += `<tr>
                              <td>${element.fecha_asignada}</td>
                              <td>${element.hora_asignada}</td>
                              <td>${element.nombre_completo} ${element.apellido_completo}</td>
                              <td>${element.nombre_empleado}</td>
                              <td>${element.nombre_servicio}</td>
                              <td>${element.estado}</td>
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
      if (data.respuesta) {
        $('#modalAgregarCita').modal('hide');
        Swal.fire({
          title: 'Mensaje',
          text: "Cita registrada correctamente!",
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
      console.log(respuesta);
      $('#idcita').val(respuesta.id);
      $('#fecha_cita').val(respuesta.fecha_asignada);
      $('#hora_cita').val(respuesta.hora_asignada);
      $('#id_cliente').val(respuesta.numero_identificacion);
      $('#nombre_cliente').val(respuesta.nombre_completo);
      $('#apellidos_cliente').val(respuesta.apellido_completo);
      $('#empleado').val(respuesta.nombre_empleado);
      $('#estudio').val(respuesta.nombre_servicio);
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
        if(respuesta){
         console.log('respuesta')

        }
       

   }
  });


 if(id){
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

$(document).ready(function () {
  listarCitas();
  imprimir();
});

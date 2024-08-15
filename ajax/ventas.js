// Cargar productos en el select
function cargarProductos() {
    $.ajax({
        type: "POST",
        url: "controladores/ventas.controlador.php",
        data: { metodo: "listar_productos" },
        dataType: "json",
        success: function (response) {
            let opciones = '<option value="" disabled selected>Seleccionar Productos</option>';
            response.forEach(function (productos) {
                opciones += `<option value="${productos.id}">${productos.nombre}</option>`;
            });
            $('#productoVenta').html(opciones);
        }
    });
}

// Cargar productos en el select
function cargarClientes() {
    $.ajax({
        type: "POST",
        url: "controladores/ventas.controlador.php",
        data: { metodo: "listar_clientes" },
        dataType: "json",
        success: function (response) {
            let opciones = '<option value="" disabled selected>Seleccionar Clientes</option>';
            response.forEach(function (clientes) {
                opciones += `<option value="${clientes.id}">${clientes.numero_identificacion} - ${clientes.nombre_completo} </option>`;
            });
            $('#clienteVenta').html(opciones);
        }
    });
}


function ListarVentas() {
    $('#tbListarVentas').dataTable({
        "bProcessing": true,
        "serverSide": false,
        "responsive": true,
        "lengthChange": true,
        "pageLength": 100,
        "bFilter": true,
        paging: true,
        searching: true,
        ajax: {
            url: 'controladores/ventas.controlador.php',
            type: 'POST',
            data: { 'metodo': 'listar_ventas' }
        },
        "bPaginate": true,
        "language": {
            url: "src/js/datatable_traduccion.json",
        },
        "aoColumns": [
            { mData: 'fecha' },
            { mData: 'consecutivo' },
            { mData: 'cedula_cliente' },
            { mData: 'nombres_cliente' },
            { mData: 'producto_nombre' },
            { mData: 'valor_venta' },
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

function registrarVenta() {
    $.ajax({
        type: "POST",
        url: "controladores/ventas.controlador.php",
        data: {
            metodo: "agregar_venta",
            data: $("#frmAgregarVenta").serialize()
        },
        dataType: 'html',
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (response) {
           /* if (response.respuesta) {
                $('#modal_agregar_venta').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    title: 'Mensaje',
                    text: "Venta registrada!",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.close();
                        $("#frmAgregarVenta")[0].reset();
                        $('#tbListarVentas').DataTable().ajax.reload(null, false);
                    }
                });
            }*/
           console.log(response);
        }
    });

    return false;
}


function VerVenta(id) {
    $.ajax({
        type: "POST",
        url: "controladores/ventas.controlador.php",
        data: {
            metodo: "consultar_venta",
            id_venta: id
        },
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (data) {
            var venta = JSON.parse(data);

            document.getElementById("fechaVenta_ver").value = venta.fecha;
            // document.getElementById("consecutivoVenta_ver").value = venta.consecutivo_venta;
            document.getElementById("clienteVenta_ver").value = venta.numero_identificacion;
            document.getElementById("productoVenta_ver").value = venta.producto_nombre;
            document.getElementById("valorVenta_ver").value = venta.valor;

            $("#modal_ver_venta").modal("show");
        }
    });
}


function EditarVenta(id) {
    $.ajax({
        type: "POST",
        url: "controladores/ventas.controlador.php",
        data: {
            metodo: "editar_venta",
            id_venta: id
        },
        beforeSend: function () { $('body').LoadingOverlay("show"); },
        complete: function () { $('body').LoadingOverlay("hide"); },
        error: function () { $('body').LoadingOverlay("hide"); },
        success: function (data) {
            var venta = JSON.parse(data);

            document.getElementById("id_venta_editar").value = venta.id;
            document.getElementById("fechaVenta_editar").value = venta.fecha;
            // document.getElementById("consecutivoVenta_editar").value = venta.consecutivo_venta;
            document.getElementById("clienteVenta_editar").value = venta.numero_identificacion;
            // document.getElementById("nombresCliente_editar").value = venta.nombres_cliente;
            document.getElementById("productoVenta_editar").value = venta.producto_nombre;
            document.getElementById("valorVenta_editar").value = venta.producto_valor;

            $("#modal_editar_venta").modal("show");
        }
    });
}

// function ActualizarVenta() {
//     $.ajax({
//         type: "POST",
//         url: "controladores/ventas.controlador.php",
//         data: {
//             metodo: "actualizar_venta",
//             data: $("#frmEditarVenta").serialize()
//         },
//         dataType: 'JSON',
//         beforeSend: function () { $('body').LoadingOverlay("show"); },
//         complete: function () { $('body').LoadingOverlay("hide"); },
//         error: function () { $('body').LoadingOverlay("hide"); },
//         success: function (response) {
//             if (response.respuesta) {
//                 $('#modal_editar_venta').modal('hide');
//                 Swal.fire({
//                     position: 'top-end',
//                     title: 'Mensaje',
//                     text: "Venta actualizada!",
//                     icon: 'success',
//                     confirmButtonText: 'Ok'
//                 }).then((result) => {
//                     if (result.isConfirmed) {
//                         $('#tbListarVentas').DataTable().ajax.reload(null, false);
//                         Swal.close();
//                         $("#frmEditarVenta")[0].reset();
//                     }
//                 });
//             }
//         }
//     });
//     return false;
// }

function EliminarVenta(id) {
    Swal.fire({
        title: "Desea eliminar esta venta?",
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
                url: "controladores/ventas.controlador.php",
                data: {
                    metodo: "eliminar_venta",
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
                            title: 'Venta eliminada',
                            showConfirmButton: false,
                            timer: 1800
                        });
                        $('#tbListarVentas').DataTable().ajax.reload(null, false);
                    } else {
                        alert("No se puede eliminar");
                    }
                }
            });
        }
    });
}


function imprimir(id) {
    $.ajax({
      type: "POST",
     url: "controladores/ventas.controlador.php",
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
          window.open('./pdf_ventas.php');
         }
       })
   }
}

document.addEventListener("DOMContentLoaded", () => {
    ListarVentas();
    cargarProductos();  // Llamamos a la función para cargar los cargos cuando se cargue la página
   // $('#frmAgregarVenta').on('submit', registrarVenta);  // Registrar empleado al enviar el formulario

    cargarClientes();  // Llamamos a la función para cargar los cargos cuando se cargue la página
   // $('#frmAgregarVenta').on('submit', registrarVenta);  // Registrar empleado al enviar el formulario


    imprimir()

    $('#productoVenta').on('change', function() {
        $("#valorVenta").val("");
        $.ajax({
            type: "POST",
            url: "controladores/productos.controlador.php",
            data: { metodo: "consultar_producto_venta", id_producto:  this.value},
            dataType: "json",
            success: function (response) {
               $("#valorVenta").val(response.precio);
            }
        });
    });
});

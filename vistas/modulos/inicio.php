<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-sm">
      <!-- <h1 class="text-center mt-5 mb-4 text-bold"></h1> -->
      <div class="row mt-2 align-items-center justify-content-center">
        <!-- Columna 1 -->
        <div class="col-md-3 mb-4">
          <div class="card h-100">
            <div class=border p-3>
              <img src="src\img\servicios2.jpg" class="card-img-top" alt="Imagen de la tarjeta">
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="card-title mb-2 text-bold">Servicios</h5>
              <p class="card-text">Gestionar Servicios</p>
              <button type="button" class="btn btn-success btn-modal" data-toggle="modal" data-target="#ModalServicios">Ver más</button>
            </div>
          </div>
        </div>
        <!-- Columna 2 -->
        <div class="col-md-3 mb-4">
          <div class="card h-100">
            <div class=border p-3>
              <img src="src\img\usuarios.jpg" class="card-img-top" alt="Imagen de la tarjeta">
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="card-title mb-2 text-bold">Clientes</h5>
              <p class="card-text text-center">Gestion de Clientes</p>
              <a href="clientes" class="btn btn-success btn-modal">Clientes</a>
            </div>
          </div>
        </div>
        <!-- Columna 1 -->
        <div class="col-md-3 mb-4">
          <div class="card h-100">
            <div class=border p-3>
              <img src="src\img\citas.jpg" class="card-img-top" alt="Imagen de la tarjeta">
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="card-title mb-2 text-bold">Citas</h5>
              <p class="card-text">Gestionar Citas</p>
              <a href="citas" class="btn btn-success btn-modal">Citas</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2 align-items-center justify-content-center">
        <!-- Columna 1 -->
        <div class="col-md-3 mb-4">
          <div class="card h-100">
            <div class=border p-3>
              <img src="src\img\reportes.jpg" class="card-img-top" alt="Imagen de la tarjeta">
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="card-title mb-2 text-bold">Reportes</h5>
              <p class="card-text">Gestionar Reportes</p>
              <button type="button" class="btn btn-success btn-modal" data-toggle="modal" data-target="#ModalReportes">Ver más</button>
            </div>
          </div>
        </div>
        <!-- Columna 2 -->
        <div class="col-md-3 mb-4">
          <div class="card h-100">
            <div class=border p-3>
              <img src="src\img\productos.jpg" class="card-img-top" alt="Imagen de la tarjeta">
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="card-title mb-2 text-bold">Ventas/Productos</h5>
              <p class="card-text text-center">Gestion de Ventas</p>
              <a href="ventas" class="btn btn-success btn-modal">Ventas</a>
            </div>
          </div>
        </div>
        <!-- Columna 2 -->
        <div class="col-md-3 mb-4">
          <div class="card h-100">
            <div class=border p-3>
              <img src="src\img\inventario.jpg" class="card-img-top" alt="Imagen de la tarjeta">
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="card-title mb-2 text-bold">Inventario</h5>
              <p class="card-text text-center">Gestion de Inventario</p>
              <a href="inventario" class="btn btn-success btn-modal">Inventario</a>
            </div>
          </div>
        </div>
      </div>

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Modal Admin -->
    <div class="modal fade" id="ModalServicios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header ">
            <h5 class="modal-title  " id="exampleModalLabel"><strong class="text-center">Servicios</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-3 mb-4">
                <div class="card h-50">
                  <div class=border p-3>
                    <img src="src\img\barberia.jpg" class="card-img-top" alt="Imagen de la tarjeta">
                  </div>
                  <div class="card-body text-center mt-3">
                    <a href="servicios" class="btn btn-success btn-block mb-3">Barberia</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="card h-50">
                  <div class=border p-3>
                    <img src="src\img\cortes.jpg" class="card-img-top" alt="Imagen de la tarjeta">
                  </div>
                  <div class="card-body text-center mt-3">
                    <a href="servicios" class="btn btn-info btn-block mb-3">Cortes</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="card h-50">
                  <div class=border p-3>
                    <img src="src\img\peinados.jpg" class="card-img-top" alt="Imagen de la tarjeta">
                  </div>
                  <div class="card-body text-center mt-3">
                    <a href="servicios" class="btn btn-primary btn-block mb-3">Peinados</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="card h-50">
                  <div class=border p-3>
                    <img src="src\img\facial.jpg" class="card-img-top" alt="Imagen de la tarjeta">
                  </div>
                  <div class="card-body text-center mt-3">
                    <a href="servicios" class="btn btn-secondary btn-block mb-3">Limpieza Facial</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal Reportes -->
    <div class="modal fade" id="ModalReportes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header ">
            <h5 class="modal-title  " id="exampleModalLabel"><strong class="text-center">Reportes</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-3 mb-4">
                <div class="card h-50">
                  <div class=border p-3>
                    <img src="src\img\barberia.jpg" class="card-img-top" alt="Imagen de la tarjeta">
                  </div>
                  <div class="card-body text-center mt-3">
                    <a href="ventas" class="btn btn-success btn-block mb-3">Ventas</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="card h-50">
                  <div class=border p-3>
                    <img src="src\img\cortes.jpg" class="card-img-top" alt="Imagen de la tarjeta">
                  </div>
                  <div class="card-body text-center mt-3">
                    <a href="citas" class="btn btn-info btn-block mb-3">Citas</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>


    <script>
      $(document).ready(function() {
        $('.btn-modal').click(function() {
          $('#ModalAdmin').modal('show');
        });
        $('.btn-modal2').click(function() {
          $('#ModalFormularios').modal('show');
        });
        $('.btn-modal3').click(function() {
          $('#ModalRP').modal('show');
        });
      });
    </script>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
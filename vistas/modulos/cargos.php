<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestión de Cargos</h1>
        </div>

      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalAgregarCargo">
    <i class="fa fa-plus-square" aria-hidden="true"></i> Registrar Cargos
    </button>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-12">
          <table id="tcargos" class="table table-bordered table-hover dt-responsive table-sm tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nombre</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>


<!-- MODAL INSERTAR-->
<div class="modal fade" id="modalAgregarCargo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form role="form" method="post" id="finsert" onsubmit= "return insertar()">
        <div class="modal-header bg-secondary">
          <h4 class="modal-title fs-5" id="exampleModalLabel"> Agregar Cargos </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- CAMPO Movil -->
            <div class="col-md-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupPrepend"> <i class="fas fa-id-card-alt"></i> </span>
                </div>
                <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre" required>
              </div>
            </div>
          </div>
          <!-- fin del row -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-secondary">Guardar Cargos</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDITAR-->
<div class="modal fade" id="modalEditarCargos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" id="fupdate" onsubmit="return actualizar()">
        <div class="modal-header bg-secondary">
          <h4 class="modal-title fs-5" id="exampleModalLabel"> Editar Cargos </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupPrepend"> <i class="fas fa-id-card-alt"></i> </span>
            </div>
            <input type="hidden" name="idcargo" id="idcargo">
            <input type="text" class="form-control" name="editarNombre" id="editarNombre" required>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión de Empleados</h1>
                </div>

            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_agregar_empleado">
            <i class="fa fa-plus-square" aria-hidden="true"></i> Registrar Empleados
        </button>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-12">
                    <table id="tabla_empleados" class="table table-striped table-bordered mt-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contenido generado dinámicamente por AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div><!-- Modal para agregar empleado -->
<div class="modal fade" id="modal_agregar_empleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_agregar_empleado">
                    <div class="form-group">
                        <label for="nombreEmpleado">Nombre</label>
                        <input type="text" class="form-control" id="nombreEmpleado" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="cargoEmpleado">Cargo</label>
                        <select class="form-control" id="cargoEmpleado" name="cargo_id" required>
                            <!-- Opciones generadas dinámicamente por AJAX -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar empleado -->
<div class="modal fade" id="modal_editar_empleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_editar_empleado">
                    <input type="hidden" id="idEmpleadoEditar" name="id_empleado">
                    <div class="form-group">
                        <label for="nombreEmpleadoEditar">Nombre</label>
                        <input type="text" class="form-control" id="nombreEmpleadoEditar" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="cargoEmpleadoEditar">Cargo</label>
                        <select class="form-control" id="cargoEmpleadoEditar" name="cargo_id" required>
                            <!-- Opciones generadas dinámicamente por AJAX -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para eliminar empleado -->
<div class="modal fade" id="modal_eliminar_empleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este empleado?</p>
                <p id="nombreEmpleadoEliminar"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btn_eliminar_empleado">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Ventas</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header bg-gradient-info">
                <h3 class="card-title text-uppercase">Ventas</h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_agregar_venta">
                    <i class="fas fa-plus-circle"></i> Nueva Venta
                </button>
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-12">
                            <table id="tbListarVentas" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <!-- <th>Consecutivo</th> -->
                                        <th>ID Cliente</th>
                                        <th>Cliente</th>
                                        <th>Producto</th>
                                        <th>Valor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Datos llenados dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal para agregar venta -->
<div class="modal fade" id="modal_agregar_venta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmAgregarVenta">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fechaVenta">Fecha</label>
                        <input type="date" class="form-control" id="fechaVenta" name="fechaVenta" required>
                    </div>
                    <div class="form-group">
                        <!-- <label for="consecutivoVenta">Consecutivo Venta</label> -->
                        <input type="hidden" class="form-control" id="consecutivoVenta" name="consecutivoVenta" required>
                    </div>
                    <div class="form-group">
                        <label for="clienteVenta">Cliente (Cédula)</label>
                        <select class="form-control" id="clienteVenta" name="clienteVenta" required>
                            <!-- Opciones llenadas dinámicamente -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productoVenta">Producto</label>
                        <select class="form-control" id="productoVenta" name="productoVenta" required>
                            <!-- Opciones llenadas dinámicamente -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="valorVenta">Valor</label>
                        <input type="text" class="form-control" id="valorVenta" name="valorVenta" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para ver detalles de venta -->
<div class="modal fade" id="modal_ver_venta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Fecha</label>
                    <input type="text" class="form-control" id="fechaVenta_ver" disabled>
                </div>
                <div class="form-group">
                    <!-- <label>Consecutivo Venta</label> -->
                    <input type="hidden" class="form-control" id="consecutivoVenta_ver" disabled>
                </div>
                <div class="form-group">
                    <label>Cliente (Cédula)</label>
                    <input type="text" class="form-control" id="clienteVenta_ver" disabled>
                </div>
                <div class="form-group">
                    <label>Producto</label>
                    <input type="text" class="form-control" id="productoVenta_ver" disabled>
                </div>
                <div class="form-group">
                    <label>Valor</label>
                    <input type="text" class="form-control" id="valorVenta_ver" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar venta -->
<div class="modal fade" id="modal_editar_venta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmEditarVenta">
                <div class="modal-body">
                    <input type="hidden" id="id_venta_editar" name="id_venta_editar">
                    <div class="form-group">
                        <label for="fechaVenta_editar">Fecha</label>
                        <input type="date" class="form-control" id="fechaVenta_editar" name="fechaVenta_editar" required>
                    </div>
                    <div class="form-group">
                        <!-- <label for="consecutivoVenta_editar">Consecutivo Venta</label> -->
                        <input type="hidden" class="form-control" id="consecutivoVenta_editar" name="consecutivoVenta_editar" required>
                    </div>
                    <div class="form-group">
                        <label for="clienteVenta_editar">Cliente (Cédula)</label>
                        <input type="text" class="form-control" id="clienteVenta_editar" name="clienteVenta_editar" required>

                    </div>
                    <div class="form-group">
                        <label for="productoVenta_editar">Producto</label>
                        <input type="text" class="form-control" id="productoVenta_editar" name="productoVenta_editar" required>

                    </div>
                    <div class="form-group">
                        <label for="valorVenta_editar">Valor</label>
                        <input type="text" class="form-control" id="valorVenta_editar" name="valorVenta_editar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para eliminar venta -->
<div class="modal fade" id="modal_eliminar_venta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de que desea eliminar esta venta?</p>
                <input type="hidden" id="id_venta_eliminar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnEliminarVenta">Eliminar</button>
            </div>
        </div>
    </div>
</div>
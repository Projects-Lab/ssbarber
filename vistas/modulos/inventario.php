<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Inventario</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title text-uppercase">Productos</h3>
            </div>
            <div class="card-body">
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
                                <i class="fas fa-plus-circle"></i> Agregar producto
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tbProductos"
                                class="table table-bordered table-striped table-hover dt-responsive table-sm"
                                style="width: 100%;">
                                <thead>
                                    <tr class="active">
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>Categoría</th>
                                        <th>Stock</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modalAgregarProducto" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProductoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title" id="modalAgregarProductoLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAgregarProducto" method="post" onsubmit=" return registrarProducto()">
                    <div class="form-group">
                        <label for="nombreProducto">Nombre</label>
                        <input type="text" class="form-control text-uppercase" name="nombreProducto" id="nombreProducto" placeholder="Nombre del producto" required>
                    </div>
                    <div class="form-group">
                        <label for="codigoProducto">Código</label>
                        <input type="text" class="form-control text-uppercase" name="codigoProducto" id="codigoProducto" placeholder="Código del producto" required>
                    </div>
                    <div class="form-group">
                        <label for="categoriaProducto">Categoría</label>
                        <select class="form-control" name="categoriaProducto" id="categoriaProducto"></select>
                    </div>
                    <div class="form-group">
                        <label for="stockProducto">Stock</label>
                        <input type="number" class="form-control" name="stockProducto" id="stockProducto" placeholder="Cantidad en stock" required>
                    </div>
                    <div class="form-group">
                        <label for="precioProducto">Precio</label>
                        <input type="number" class="form-control" name="precioProducto" id="precioProducto" placeholder="Precio del producto" step="0.01" required>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary float-right" id="btnGuardar">Guardar producto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver producto -->
<div class="modal fade" id="modalVerProducto" tabindex="-1" role="dialog" aria-labelledby="modalVerProductoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title" id="modalVerProductoLabel">Detalles del Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="text" class="form-control" id="idProducto_ver" disabled>

                    <div class="form-group">
                        <label for="verNombreProducto">Nombre</label>
                        <input type="text" class="form-control" id="verNombreProducto" disabled>
                    </div>
                    <div class="form-group">
                        <label for="verCodigoProducto">Código</label>
                        <input type="text" class="form-control" id="verCodigoProducto" disabled>
                    </div>
                    <div class="form-group">
                        <label for="verCategoriaProducto">Categoría</label>
                        <input type="text" class="form-control" id="verCategoriaProducto" disabled>
                    </div>
                    <div class="form-group">
                        <label for="verStockProducto">Stock</label>
                        <input type="number" class="form-control" id="verStockProducto" disabled>
                    </div>
                    <div class="form-group">
                        <label for="verPrecioProducto">Precio</label>
                        <input type="number" class="form-control" id="verPrecioProducto" step="0.01" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar producto -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title" id="modalEditarProductoLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarProducto">
                    <input type="text" class="form-control" id="id_producto_editar" disabled>

                    <div class="form-group">
                        <label for="editarNombreProducto">Nombre</label>
                        <input type="text" class="form-control" id="editarNombreProducto" required>
                    </div>
                    <div class="form-group">
                        <label for="editarCodigoProducto">Código</label>
                        <input type="text" class="form-control" id="editarCodigoProducto" required>
                    </div>
                    <div class="form-group">
                        <label for="editarCategoriaProducto">Categoría</label>
                        <input type="text" class="form-control" id="editarCategoriaProducto" required>
                    </div>
                    <div class="form-group">
                        <label for="editarStockProducto">Stock</label>
                        <input type="number" class="form-control" id="editarStockProducto" required>
                    </div>
                    <div class="form-group">
                        <label for="editarPrecioProducto">Precio</label>
                        <input type="number" class="form-control" id="editarPrecioProducto" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
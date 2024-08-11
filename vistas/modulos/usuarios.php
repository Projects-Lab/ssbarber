<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div>
        </div>
    </section>
    <!-- <?php print_r($_SESSION)?> -->
    <section class="content">
        <div class="card">
            <div class="card-header bg-gradient-info">
                <h3 class="card-title text-uppercase">Usuarios</h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalAgregarUsuario">
                    <i class="fas fa-user-plus"></i> Crear usuario
                </button>
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-12">
                            <table id="tbUsuarios"
                                class="table table-bordered table-striped table-hover dt-responsive table-sm"
                                style="width: 100%;">
                                <thead>
                                    <tr class="active">
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Perfil</th>
                                        <th>Estado</th>
                                        <th>Registro</th>
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

<!-- MODAL AGREGAR USUARIO -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" data-backdrop="static" data-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-1 pb-1 bg-gradient-info">
                <h5 class=" modal-title text-white">Agregar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="frmRegistrar" onsubmit="return insertar()" method="post" autocomplete="off">
                    <!-- CAMPO NOMBRE COMPPLETO -->
                    <div class="col-md-12">
                        <label for="">Nombres</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"> <i
                                        class="fas fa-id-card-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre completo"
                                required>
                        </div>
                    </div>
                    <!-- CAMPO USUARIO DEL SISTEMA -->
                    <div class="col-md-12 mt-2">
                        <label for="">Usuario</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"> <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="nuevoUsuario" placeholder="Ingresar usuario"
                                required>
                        </div>
                    </div>
                    <!-- CAMPO  CONTRASEÑA DEL USUARIO DEL SISTEMA -->
                    <div class="col-md-12 mt-2">
                        <label for="">Clave</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"> <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="nuevoPassword"
                                placeholder="Ingresar contraseña" required>
                        </div>
                    </div>
                    <!-- CAMPO USUARIO DEL PERFIL -->
                    <div class="col-md-12 mt-2">
                        <label for="">Rol</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"> <i class="fa fa-cogs"></i>
                                </span>
                            </div>
                            <select class="form-control input-lg" name="nuevoPerfil" required>
                                <option value="" selected disabled>Selecionar perfil</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Recepcion">Recepcion</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-2 float-right">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-info">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDITAR USUARIO -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" data-backdrop="static" data-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-1 pb-1 bg-gradient-info">
                <h5 class=" modal-title text-white">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="frmActualizar" onsubmit="return actualizar()" method="post" autocomplete="off">
                    <!-- CAMPO NOMBRE COMPPLETO -->
                    <input type="hidden" id="usuario_id" name="usuario_id">
                    <div class="col-md-12 mt-2">
                        <label for="">Nombres</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"> <i
                                        class="fas fa-id-card-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="nuevoNombre_u" id="nuevoNombre_u"
                                placeholder="Nombre completo" required>
                        </div>
                    </div>
                    <!-- CAMPO USUARIO DEL SISTEMA -->
                    <div class="col-md-12 mt-2">
                        <label for="">Usuario</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"> <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="nuevoUsuario_u" id="nuevoUsuario_u"
                                placeholder="Ingresar usuario" required>
                        </div>
                    </div>
                    <!-- CAMPO USUARIO DEL PERFIL -->
                    <div class="col-md-12 mt-2">
                        <label for="">Rol</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"> <i class="fa fa-cogs"></i>
                                </span>
                            </div>
                            <select class="form-control input-lg" name="nuevoPerfil_u" id="nuevoPerfil_u" required>
                                <option value="" selected disabled>Selecionar perfil</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Recepcion">Recepcionista</option>
                                <option value="Medico">Medico</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="">Estado</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"> <i class="fa fa-cogs"></i>
                                </span>
                            </div>
                            <select class="form-control input-lg" name="nuevoEstado_u" id="nuevoEstado_u" required>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-2 float-right">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-info">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
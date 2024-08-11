<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión de Citas</h1>
                </div>

            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalAgregarCita">
            <i class="fa fa-plus-square" aria-hidden="true"></i> Agendar Citas
        </button>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <table id="tcitas" class="table table-bordered table-hover dt-responsive table-sm tablas">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Servicio</th>
                                <th>Empleado Encargado</th>
                                <th>Estado Cita</th>
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
<div class="modal fade" id="modalAgregarCita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title fs-5" id="exampleModalLabel"> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAgregarPaciente" onsubmit="return registrarPaciente()" method="post" autocomplete="off">

                    <h4>Agendar Nueva Cita</h4>
                    <hr>
                    <div class="row text-center justify-content-center">

                        <div class="col-md-3">
                            <label for="fecha_cita">Fecha de la Cita:</label>
                            <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" required>
                        </div>
                        <div class="col-md-3">
                            <label for="hora_cita">Hora de la Cita:</label>
                            <input type="time" class="form-control" id="hora_cita" name="hora_cita" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="id_paciente">ID Cliente:</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="id_paciente" name="id_paciente" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="buscarPaciente"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="id_paciente">Nombres:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="nombre_paciente" name="nombre_paciente" required>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="id_paciente">Apellidos:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="nombre_paciente" name="nombre_paciente" required>
                            </div>
                        </div>

                    </div>
                    <!-- fin del row -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="estudio">Servicio:</label>
                            <select class="form-control" id="estudio" name="estudio" required>
                            <option value="O">Barberia</option>
                            <option value="O">Corte de Cabello</option>
                            <option value="O">Depilacion</option>
                            <option value="O">Pedicure</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="empleado">Empleado Encargado:</label>
                            <select class="form-control" id="empleado" name="medico" required>
                            <option value="O">Jorge Uribe</option>
                            <option value="O">Critobal Silva</option>
                            <option value="O">Luis Lopez</option>
                            <option value="O">Monica Chivatá</option>
                            </select>
                        </div>

                    </div>
                    <!-- fin del row -->
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Agendar Cita</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
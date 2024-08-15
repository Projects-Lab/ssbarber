<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header bg-gradient-info">
                <h3 class="card-title text-uppercase">Gestión Clientes</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_agregar_paciente">
                            <i class="fas fa-user-plus"></i> Nuevo Cliente
                        </button>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <table id="tbListarPaciente" class="table table-bordered table-hover dt-responsive table-sm" width='100%'>
                            <thead>
                                <tr class="bg-gradient-light">
                                    <th>Tipo Documento</th>
                                    <th>N° Identificación</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Celular</th>
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
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_agregar_paciente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-1 pb-1 bg-gradient-info">
                <h5 class=" modal-title text-white">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAgregarPaciente" onsubmit="return registrarPaciente()" method="post" autocomplete="off">
                    <h5 class="text-center mb-4">Datos del Cliente</h5>
                    <hr>
                    <div class="row">
                        <!-- tipo de doc -->
                        <div class="col-md-3">
                            <label for="">Tipo Documento</label>
                            <select class="form-control form-control-sm" name="tipoDocumentoPaciente" id="tipoDocumentoPaciente" required>
                                <option selected disabled value="">Seleccione</option>
                                <option value="CC">Cedula Ciudadania</option>
                                <option value="TI">Tarjeta Identidad</option>
                                <option value="CE">Cedula Extranjeria</option>
                                <option value="PPT">PPT</option>
                            </select>
                        </div>
                        <!-- NUMERO DE INDENTIFICACION -->
                        <div class="col-md-3">
                            <label for="">Identificación</label>
                            <input type="text" maxlength="16" class="form-control form-control-sm" name="identificacionPaciente" id="identificacionPaciente" placeholder="Número de documento" required>
                        </div>

                    </div>
                    <div class="row">
                        <!-- NOMBRES -->
                        <div class="col-md-3 mt-3">
                            <label for="">Primer nombre</label>
                            <input type="text" class="form-control form-control-sm" name="primerNombrePaciente" id="primerNombrePaciente" style="text-transform: uppercase;" placeholder="Primer Nombre" required>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="">Segundo nombre</label>
                            <input type="text" class="form-control form-control-sm" name="segundoNombrePaciente" id="segundoNombrePaciente" style="text-transform: uppercase;" placeholder="Segundo Nombre">
                        </div>
                        <!-- APELLIDOS -->
                        <div class="col-md-3 mt-3">
                            <label for="">Primer apellido</label>
                            <input type="text" class="form-control form-control-sm" name="primerApellidoPaciente" id="primerApellidoPaciente" style="text-transform: uppercase;" placeholder="Primer Apellido" required>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="">Segundo apellido</label>
                            <input type="text" class="form-control form-control-sm" name="segundoApellidoPaciente" id="segundoApellidoPaciente" style="text-transform: uppercase;" placeholder="Segundo Apellido">
                        </div>
                    </div>
                    <!-- fin del row -->
                    <div class="row">
                        <!-- FECHA NACIMIENTO -->
                        <div class="col-md-3 mt-3">
                            <label for="">Fecha nacimiento</label>
                            <input type="date" class="form-control form-control-sm" name="fechaNacimientoPaciente" id="fechaNacimientoPaciente" required data-toggle="tooltip" data-placement="top" title="Fecha nacimiento" oninput="calcularEdad1(this.value)">
                        </div>
                        <!-- EDAD -->
                        <div class="col-md-1 mt-3">
                            <label for="">Edad</label>
                            <input type="number" class="form-control form-control-sm" name="edadPaciente" id="edadPaciente" placeholder="Edad" readonly inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            <script>
                                function calcularEdad1(fechaNacimiento) {
                                    var fechaActual = new Date();
                                    var fechaNac = new Date(fechaNacimiento);
                                    var edad = fechaActual.getFullYear() - fechaNac.getFullYear();

                                    // Verificar si el cumpleaños aún no ha pasado este año
                                    var mesActual = fechaActual.getMonth();
                                    var diaActual = fechaActual.getDate();
                                    var mesNac = fechaNac.getMonth();
                                    var diaNac = fechaNac.getDate();

                                    if (mesActual < mesNac || (mesActual === mesNac && diaActual < diaNac)) {
                                        edad--;
                                        frmAgregarPaciente
                                    }

                                    document.getElementById('edadPaciente').value = edad;
                                }
                            </script>
                        </div>
                        <!-- SEXO -->
                        <div class="col-md-4 mt-3">
                            <label for="">Sexo</label>
                            <select class="form-control form-control-sm" name="generoPaciente" id="generoPaciente" required>
                                <option selected disabled value="">Seleccione</option>
                                <option value="F">FEMENINO</option>
                                <option value="M">MASCULINO</option>
                                <option value="O">OTRO</option>
                            </select>
                        </div>
                        <!-- ocupacion -->
                        <!-- <div class="col-md-4 mt-3">
                            <label for="">Ocupación</label>
                            <input type="text" class="form-control form-control-sm" style="text-transform: uppercase;" name="pacienteOcupacion" id="pacienteOcupacion" placeholder="Ocupación">
                        </div> -->
                    </div>

                    <!-- FIN DEL ROW -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="mt-4 mb-2 text-center">Datos de contacto</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <!-- celular -->
                        <div class="col-md-3 mt-3">
                            <label for="">Celular Cliente</label>
                            <input type="text" class="form-control form-control-sm" name="celularPaciente" id="celularPaciente" placeholder="Celular" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <!-- DIRECCION DE RESIDENCIA -->
                        <div class="col-md-3 mt-3">
                            <label for="">Dirección</label>
                            <input type="text" class="form-control form-control-sm" name="direccionResidenciaPaciente" id="direccionResidenciaPaciente" placeholder="Dirección de residencia" required>
                            <p id="direccionError" style="color: red; display: none;">Error, No se permiten caracteres especiales.</p>
                        </div>
                        <!-- departamento -->
                        <div class="col-md-3 mt-3">
                            <label for="">Departamento</label>
                            <select name="departamentoPaciente" class="form-control form-control-sm" id="departamentoPaciente" aria-placeholder="Departameno" required onchange="listarMunicipio(this)"></select>
                        </div>
                        <!-- CIUDAD -->
                        <div class="col-md-3 mt-3">
                            <label for="">Municipio</label>
                            <select name="municipioPaciente" class="form-control form-control-sm" id="municipioPaciente" aria-placeholder="municipio Paciente" required>
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                    <!-- FIN DEL ROW -->
                    <div class="row">



                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-2 float-right">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button id="btnGuardar" type="submit" class="btn btn-info">Guardar Cliente</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("direccionResidenciaPaciente").addEventListener("input", function() {
            var direccionInput = this.value;
            var direccionRegex = /^[a-zA-Z0-9\s]+$/;

            if (!direccionRegex.test(direccionInput)) {
                document.getElementById("direccionError").style.display = "block";
            } else {
                document.getElementById("direccionError").style.display = "none";
            }
        });
    </script>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_ver_paciente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-1 pb-1 bg-gradient-info">
                <h5 class=" modal-title text-white">Información del Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-primary">Datos del Cliente</h5>
                <div class="row">
                    <!-- tipo de doc -->
                    <div class="col-md-3">
                        <label for="">Tipo documento</label>
                        <input type="text" class="form-control form-control-sm" id="tipoDocumentoPaciente_ver" readonly>
                    </div>
                    <!-- NUMERO DE INDENTIFICACION -->
                    <div class="col-md-3">
                        <label for="">Identificación</label>
                        <input type="text" class="form-control form-control-sm" name="identificacionPaciente_ver" id="identificacionPaciente_ver" placeholder="Número de documento" readonly>
                    </div>
                    <!-- NOMBRES -->
                    <div class="col-md-3">
                        <label for="">Primer nombre</label>
                        <input type="text" class="form-control form-control-sm" name="primerNombrePaciente" id="primerNombrePaciente_ver" placeholder="Primer Nombre" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="">Segundo nombre</label>
                        <input type="text" class="form-control form-control-sm" name="segundoNombrePaciente" id="segundoNombrePaciente_ver" placeholder="Segundo Nombre" readonly>
                    </div>
                </div>
                <div class="row">
                    <!-- APELLIDOS -->
                    <div class="col-md-3 mt-3">
                        <label for="">Primer apellido</label>
                        <input type="text" class="form-control form-control-sm" name="primerApellidoPaciente" id="primerApellidoPaciente_ver" placeholder="Primer Apellido" readonly>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="">Segundo apellido</label>
                        <input type="text" class="form-control form-control-sm" name="segundoApellidoPaciente" id="segundoApellidoPaciente_ver" placeholder="Segundo Apellido" readonly>
                    </div>
                    <!-- SEXO -->
                    <div class="col-md-3 mt-3">
                        <label for="">Sexo</label>
                        <input type="text" class="form-control form-control-sm" name="generoPaciente" id="generoPaciente_ver" readonly>
                    </div>
                    <!-- FECHA NACIMIENTO -->
                    <div class="col-md-2 mt-3">
                        <label for="">Fecha nacimiento</label>
                        <input type="date" class="form-control form-control-sm" name="fechaNacimientoPaciente" id="fechaNacimientoPaciente_ver" readonly title="Fecha nacimiento">
                    </div>
                    
                    <!-- EDAD -->
                    <div class="col-md-1 mt-3">
                        <label for="">Edad</label>
                        <input type="text" class="form-control form-control-sm" name="edadPaciente" id="edadPaciente_ver" placeholder="Edad" readonly>
                    </div>
                </div>
                <!-- fin del row -->

                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="mt-4 text-primary">Datos de contacto del Cliente</h5>
                    </div>
                </div>
                <div class="row">
                    <!-- celular -->
                    <div class="col-md-3">
                        <label for="">Celular</label>
                        <input type="text" class="form-control form-control-sm" name="celularPaciente" id="celularPaciente_ver" placeholder="Celular" readonly>
                    </div>
                    
                    <!-- DIRECCION DE RESIDENCIA -->
                    <div class="col-md-3">
                        <label for="">Dirección</label>
                        <input type="text" class="form-control form-control-sm" name="direccionResidenciaPaciente" id="direccionResidenciaPaciente_ver" placeholder="Dirección de residencia" readonly>
                    </div>
                    
                    <!-- departamento -->
                    <div class="col-md-3">
                        <label for="">Departamento</label>
                        <input type="text" class="form-control form-control-sm" id="departamentoPaciente_ver" aria-placeholder="Departameno" readonly>
                    </div>
                    <!-- CIUDAD -->
                    <div class="col-md-3">
                        <label for="">Municipio</label>
                        <input type="text" class="form-control form-control-sm" id="municipioPaciente_ver" aria-placeholder="municipio Paciente" readonly>
                    </div>
                </div>
                <!-- FIN DEL ROW -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_paciente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-1 pb-1 bg-gradient-info">
                <h5 class=" modal-title text-white">Editar paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditarPaciente" onsubmit="return ActualizarPaciente()" method="post" autocomplete="off">
                    <h5 class="text-primary">Datos del paciente</h5>
                    <hr>
                    <div class="row">
                        <!-- tipo de doc -->
                        <div class="col-md-3">
                            <label for="">Tipo documento</label>
                            <select class="form-control form-control-sm" name="tipoDocumentoPaciente" id="tipoDocumentoPaciente_editar" required>
                            </select>
                            <input type="hidden" id="id_paciente_editar" name="id_paciente_editar">
                        </div>
                        <!-- NUMERO DE INDENTIFICACION -->
                        <div class="col-md-3">
                            <label for="">Identificación</label>
                            <input type="text" class="form-control form-control-sm" name="identificacionPaciente_editar" id="identificacionPaciente_editar" placeholder="Número de documento" required>
                        </div>
                        
                        <!-- FECHA NACIMIENTO -->
                        <div class="col-md-2">
                            <label for="">Fecha nacimiento</label>
                            <input type="date" class="form-control form-control-sm" name="fechaNacimientoPaciente" id="fechaNacimientoPaciente_editar"  oninput="calcularEdad(this.value)" required data-toggle="tooltip" data-placement="top" title="Fecha nacimiento" >
                        </div>
                        <!-- EDAD -->
                        <div class="col-md-1">
                            <label for="">Edad</label>
                            <input type="text" class="form-control form-control-sm" name="edadPaciente" id="edadPaciente_editar" placeholder="Edad" readonly required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <script>
                                function calcularEdad(fechaNacimiento) {
                                    var fechaActual = new Date();
                                    var fechaNac = new Date(fechaNacimiento);
                                    var edad = fechaActual.getFullYear() - fechaNac.getFullYear();

                                    // Verificar si el cumpleaños aún no ha pasado este año
                                    var mesActual = fechaActual.getMonth();
                                    var diaActual = fechaActual.getDate();
                                    var mesNac = fechaNac.getMonth();
                                    var diaNac = fechaNac.getDate();

                                    if (mesActual < mesNac || (mesActual === mesNac && diaActual < diaNac)) {
                                        edad--;
                                        frmAgregarPaciente
                                    }

                                    document.getElementById('edadPaciente_editar').value = edad;
                                }
                            </script>
                        <!-- SEXO -->
                        <div class="col-md-3">
                            <label for="">Género</label>
                            <select class="form-control form-control-sm" name="generoPaciente" id="generoPaciente_editar">
                                <option selected disabled>Seleccione</option>
                                <option value="F">FEMENINO</option>
                                <option value="M">MASCULINO</option>
                                <option value="O">OTRO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <!-- NOMBRES -->
                        <div class="col-md-3 mt-3">
                            <label for="">Primer nombre</label>
                            <input type="text" class="form-control form-control-sm" name="primerNombrePaciente" id="primerNombrePaciente_editar" placeholder="Primer Nombre" required>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="">Segundo nombre</label>
                            <input type="text" class="form-control form-control-sm" name="segundoNombrePaciente" id="segundoNombrePaciente_editar" placeholder="Segundo Nombre">
                        </div>
                        <!-- APELLIDOS -->
                        <div class="col-md-3 mt-3">
                            <label for="">Primer apellido</label>
                            <input type="text" class="form-control form-control-sm" name="primerApellidoPaciente" id="primerApellidoPaciente_editar" placeholder="Primer Apellido" required>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="">Segundo apellido</label>
                            <input type="text" class="form-control form-control-sm" name="segundoApellidoPaciente" id="segundoApellidoPaciente_editar" placeholder="Segundo Apellido">
                        </div>

                    </div>
                    <!-- fin del row -->
                    <div class="row">


                    </div>

                    <!-- FIN DEL ROW -->
                    <div class="row">
                        <div class="col-sm-4">
                            <h5 class="mt-4 mb-2 text-center">Datos de contacto</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <!-- celular -->
                        <div class="col-md-3 mt-3">
                            <label for="">Celular</label>
                            <input type="text" class="form-control form-control-sm" name="celularPaciente" id="celularPaciente_editar" placeholder="Celular" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <!-- DIRECCION DE RESIDENCIA -->
                        <div class="col-md-3 mt-3">
                            <label for="">Dirección</label>
                            <input type="text" class="form-control form-control-sm" name="direccionResidenciaPaciente" id="direccionResidenciaPaciente_editar" placeholder="Dirección de residencia" required>
                            <p id="direccionError2" style="color: red; display: none;">Error, Caracter no válido.</p>
                        </div>
                        <!-- departamento -->
                        <div class="col-md-3 mt-3">
                            <label for="">Departamento</label>
                            <select name="departamentoPaciente_editar" class="form-control form-control-sm" id="departamentoPaciente_editar" aria-placeholder="Departameno" required onchange="listarMunicipio(this)"></select>
                        </div>
                        <!-- CIUDAD -->
                        <div class="col-md-3 mt-3">
                            <label for="">Municipio</label>
                            <select name="municipioPaciente" class="form-control form-control-sm" id="municipioPaciente_editar" aria-placeholder="municipio Paciente" required>
                                <option value="">Seleccione</option>
                            </select>
                        </div>


                    </div>
                    <!-- fin del row -->
            </div>

            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-2 float-right">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById("direccionResidenciaPaciente_editar").addEventListener("input", function() {
        var direccionInput = this.value;
        var direccionRegex = /^[a-zA-Z0-9\s]+$/;

        if (!direccionRegex.test(direccionInput)) {
            document.getElementById("direccionError2").style.display = "block";
        } else {
            document.getElementById("direccionError2").style.display = "none";
        }
    });
</script>

</div>
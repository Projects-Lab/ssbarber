<?php
require_once '../modelos/pacientes.modelo.php';

class ControladorPacientes
{

    static public function ctrListarPacientes()
    {
        return ModeloPacientes::mdlListarPacientes();
    }

    /*Ubicaciones ======================================================*/
    static public function ctrListarDepartamento()
    {
        return ModeloPacientes::mdlListarDepartamento();
    }

    static public function ctrListarMunicipio($departamento)
    {
        return ModeloPacientes::mdlListarMunicipio($departamento);
    }

    static public function ctrAgregarAseguradora($nombre)
    {
        return ModeloPacientes::mdlAgregarAseguradora($nombre);
    }

    /*Tipo documento ===================================================*/
    static public function ctrListarTipoDocumento()
    {
        return ModeloPacientes::mdlListarTipoDocumento();
    }

    static public function ctrAgregarPaciente($datos)
    {
        return ModeloPacientes::mdlRegistrarPaciente($datos);
    }

    static public function ctrConsultarPaciente($paciente)
    {
        return ModeloPacientes::mdlConsultarPaciente($paciente);
    }

    static public function ctrEditarPaciente($id)
    {
        return ModeloPacientes::mdlEditarPaciente($id);
    }

    static public function ctrActualizarPaciente($datos)
    {
        return ModeloPacientes::mdlActualizarPaciente($datos);
    }

    static public function ctrEliminarPaciente($datos)
    {
        return ModeloPacientes::mdlEliminarPaciente($datos);
    }

    /*Aseguradora ============================================================*/
    static public function ctrListarAseguradora()
    {
        return ModeloPacientes::mdlListarAseguradora();
    }
        static public function ctrValidarPaciente($numero_identificacion)
    {
        return ModeloPacientes::mdlValidarPaciente($numero_identificacion);
    }
}

$objeto = new ControladorPacientes();

if ($_POST['metodo'] == 'validar_existencia') {
    $numero_identificacion = $_POST['numero_identificacion'];
    if ($objeto::ctrValidarPaciente($numero_identificacion)) {
        echo json_encode(["respuesta" => true]);
    }else{
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'listar_aseguradora') {
    echo json_encode($objeto::ctrListarAseguradora());
}

if ($_POST['metodo'] == 'agregar_aseguradora') {
    $nombre = strtoupper($_POST['nombreAseguradora']);
    echo json_encode($objeto::ctrAgregarAseguradora($nombre));
}

if ($_POST['metodo'] == 'tipo_documento') {
    echo json_encode($objeto::ctrListarTipoDocumento());
}

if ($_POST['metodo'] == 'listar_departamentos') {
    echo json_encode($objeto::ctrListarDepartamento());
}

if ($_POST['metodo'] == 'listar_municipio') {
    $departamento = $_POST['departamento'];
    echo json_encode($objeto::ctrListarMunicipio($departamento));
}

if ($_POST['metodo'] == 'consultar_paciente') {
    $paciente = $_POST['id_paciente'];
    echo json_encode($objeto::ctrConsultarPaciente($paciente));
}

if ($_POST['metodo'] == 'editar_paciente') {
    $paciente = $_POST['id_paciente'];
    echo json_encode($objeto::ctrEditarPaciente($paciente));
}

if ($_POST['metodo'] == 'agregar_paciente') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrAgregarPaciente($arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'actualizar_paciente') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrActualizarPaciente($arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'listar_pacientes') {
    $data = $objeto::ctrListarPacientes();
    $results = [];
    $list = [];
    if (count($data) > 0) {
        foreach ($data as $value) {
            $list[] = [
                "nombres" => $value['primer_nombre'] . ' ' . $value['segundo_nombre'],
                "apellidos" => $value['primer_apellido'] . ' ' . $value['segundo_apellido'],
                "descripcion" => $value['descripcion'],
                "numero_identificacion" => $value['numero_identificacion'],
                "telefonos" => $value['telefono_1'],
                "op" => "
                    <button type='button' class='btn btn-primary btn-sm' title='Ver paciente' onclick='VerPaciente({$value['id']})'>
                        <i class='far fa-eye'></i>
                    </button>
                    <button type='button' class='btn btn-warning btn-sm' title='Editar paciente' onclick='EditarPaciente({$value['id']})'>
                        <i class='fas fa-edit text-white'></i>
                    </button>
                    <button type='button' class='btn btn-danger btn-sm'  title='Eliminar paciente' onclick='EliminarPaciente({$value['id']})'>
                        <i class='fas fa-trash-alt'></i>
                    </button>"
            ];
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($list),
            "iTotalDisplayRecords" => count($list),
            "aaData" => $list
        );
    } else {
        $results = array(
            "sEcho" => 0,
            "iTotalRecords" => count($list),
            "iTotalDisplayRecords" => count($list),
            "aaData" => $list
        );
    }

    echo json_encode($results);
}

if ($_POST['metodo'] == 'eliminar_paciente') {
    $paciente = $_POST['id'];
    if ($objeto::ctrEliminarPaciente($paciente)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

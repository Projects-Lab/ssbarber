<?php
require_once '../modelos/citas.modelo.php';

class ControladorCitas
{

    static public function ctrListarMedicos()
    {
        return ModeloCitas::mdlListarMedicos();
    }
    static public function ctrListarEstudios()
    {
        return ModeloCitas::mdlListarEstudios();
    }

    // Citas
    static public function ctrListarCitas()
    {
        return ModeloCitas::mdlListarCitas();
    }
}

$objeto = new ControladorCitas();

if ($_POST['metodo'] == 'listar_medicos') {
    echo json_encode($objeto::ctrListarMedicos());
}

if ($_POST['metodo'] == 'listar_estudios') {
    echo json_encode($objeto::ctrListarEstudios());
}


if ($_POST['metodo'] == 'listar_citas') {
    $data = $objeto::ctrListarCitas();
    $results = [];
    $list = [];
    if (count($data) > 0) {
        foreach ($data as $value) {
            $list[] = [
                "fecha" => $value['fechaAsignada'],
                "hora" => $value['horaCita'],
                "idPaciente" => $value['idPaciente'],
                "paciente" => $value['paciente'],
                "medico" => $value['medico'],
                "estudio" => $value['estudio'],
                "estado" => $value['estadoCita'],
                "op" => "
                    <button type='button' class='btn btn-primary btn-sm' title='Ver Cita' '>
                        <i class='far fa-eye'></i>
                    </button>
                    <button type='button' class='btn btn-warning btn-sm' title='Editar Cita'>
                        <i class='fas fa-edit text-white'></i>
                    </button>
                    <button type='button' class='btn btn-danger btn-sm'  title='Eliminar Cita' >
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

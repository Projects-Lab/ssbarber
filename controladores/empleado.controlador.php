<?php
require "../modelos/empleados.modelo.php";


class ControladorEmpleados
{
    // Agregar empleado
    public static function ctrAgregarEmpleado($datos)
    {
        return ModeloEmpleados::mdlAgregarEmpleado($datos);
    }

    // Consultar empleado
    public static function ctrConsultarEmpleado($id_empleado)
    {
        return ModeloEmpleados::mdlConsultarEmpleado($id_empleado);
    }

    // Editar empleado (obtiene los datos para editarlos)
    public static function ctrEditarEmpleado($id_empleado)
    {
        return ModeloEmpleados::mdlConsultarEmpleado($id_empleado); // Usa la misma función de consulta para obtener los datos
    }

    // Actualizar empleado
    public static function ctrActualizarEmpleado($datos)
    {
        return ModeloEmpleados::mdlActualizarEmpleado($datos);
    }

    // Listar empleados
    public static function ctrListarEmpleados()
    {
        return ModeloEmpleados::mdlListarEmpleados();
    }

    // Eliminar empleado
    public static function ctrEliminarEmpleado($id_empleado)
    {
        return ModeloEmpleados::mdlEliminarEmpleado($id_empleado);
    }
}

$objeto = new ControladorEmpleados();

// Procesar las solicitudes AJAX
if ($_POST['metodo'] == 'agregar_empleado') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrAgregarEmpleado($arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'consultar_empleado') {
    $id_empleado = $_POST['id_empleado'];
    echo json_encode($objeto::ctrConsultarEmpleado($id_empleado));
}

if ($_POST['metodo'] == 'editar_empleado') {
    $id_empleado = $_POST['id_empleado'];
    echo json_encode($objeto::ctrEditarEmpleado($id_empleado));
}

if ($_POST['metodo'] == 'actualizar_empleado') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrActualizarEmpleado($arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'listar_empleados') {
    $data = $objeto::ctrListarEmpleados();
    $results = [];
    $list = [];
    if (count($data) > 0) {
        foreach ($data as $value) {
            $list[] = [
                "nombre" => $value['nombre'],
                "cargo" => $value['cargo'], // Este campo viene de la tabla relacionada "cargos"
                "op" => "
                    <button type='button' class='btn btn-primary btn-sm' title='Ver empleado' hidden onclick='verEmpleado({$value['id']})'>
                        <i class='far fa-eye'></i>
                    </button>
                    <button type='button' class='btn btn-warning btn-sm' title='Editar empleado' onclick='editarEmpleado({$value['id']})'>
                        <i class='fas fa-edit text-white'></i>
                    </button>
                    <button type='button' class='btn btn-danger btn-sm' title='Eliminar empleado' onclick='eliminarEmpleado({$value['id']})'>
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

if ($_POST['metodo'] == 'eliminar_empleado') {
    $id_empleado = $_POST['id'];
    if ($objeto::ctrEliminarEmpleado($id_empleado)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

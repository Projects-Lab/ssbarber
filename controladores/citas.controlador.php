<?php
require "../modelos/citas.modelo.php";

class ControladorCitas
{

    static public function Listar($tabla, $item, $valor)
    {
        return ModeloCitas::mdlListar($tabla, $item, $valor);
    }

    static public function Insertar($tabla, $datos)
    {
        return ModeloCitas::mdlIngresar($tabla, $datos);
    }

    static public function Actualizar($tabla, $datos)
    {
        return ModeloCitas::mdlActualizar($tabla, $datos);
    }

    static public function Eliminar($id)
    {
        return ModeloCitas::mdlEliminar($id);
    }

    static public function Editar($id)
    {
        return ModeloCitas::mdObtener($id);
    }

    static public function Imprimir($id)
    {
        return ModeloCitas::mdObtener($id);
    }

    static public function ListarcLiente($numero)
    {
        return ModeloCitas::mdlListarCliente($numero);
    }

    static public function Listarservicios()
    {
        return ModeloCitas::mdlListarServios();
    }

    static public function ListarEmpleados()
    {
        return ModeloCitas::mdlListarEmpleados();
    }

    static public function AtenderCita($id_cita)
    {
        return ModeloCitas::mdlAtenderCita($id_cita);
    }
}

$objeto = new ControladorCitas();

if (isset($_POST['metodo']) && $_POST['metodo'] == 'imprimir') {
    $id = $_POST['id'];
    $registro = $objeto::Imprimir($id);
    $jsonData = json_encode($registro);

    // Guardar los datos en un archivo JSON
    $jsonDatos = json_encode($registro);
    file_put_contents('citasdatos.json', $jsonDatos);
}


if (isset($_POST['metodo']) && $_POST['metodo'] == 'listar') {
    echo json_encode($objeto::Listar('citas', '', ''));
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'insertar') {
    parse_str($_POST['data'], $arrDatos);
    $arrDatos['estado'] = "P";
    if ($objeto::Insertar('citas', $arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'actualizar') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::Actualizar('citas', $arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'eliminar') {
    $delete = $_POST['id'];
    echo json_encode($objeto::Eliminar($delete));
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'editar') {
    $id = $_POST['id'];
    $registro = $objeto::Editar($id);
    echo json_encode($registro);
}


if (isset($_POST['metodo']) && $_POST['metodo'] == 'consultar_cliente') {
    $numero = $_POST["numero"];
    echo json_encode($objeto::ListarcLiente($numero));
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'listar_servicios') {
    echo json_encode($objeto::Listarservicios());
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'listar_empleados') {
    echo json_encode($objeto::ListarEmpleados());
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'atender_cita') {
    $id_cita = $_POST["id_cita"];
    if ($objeto::AtenderCita($id_cita)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

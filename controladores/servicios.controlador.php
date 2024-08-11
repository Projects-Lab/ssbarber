<?php
require "../modelos/servicios.modelo.php";

class ControladorServicios {

    static public function Listar($tabla, $item, $valor) {
        return ModeloServicios::mdlListar($tabla, $item, $valor);
    }

    static public function Actualizar($tabla, $datos) {
        return ModeloServicios::mdlActualizar($tabla, $datos);
    }

    static public function Eliminar($id) {
        return ModeloServicios::mdlEliminar($id);
    }

    static public function Editar($id) {
        return ModeloServicios::mdlObtener($id);
    }

    static public function Insertar($tabla, $datos) {
        return ModeloServicios::mdlIngresar($tabla, $datos);
    }
}

$objeto = new ControladorServicios();

if (isset($_POST['metodo']) && $_POST['metodo'] == 'listar') {
    echo json_encode($objeto::Listar('servicios', '', ''));
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'insertar') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::Insertar('servicios', $arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'actualizar') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::Actualizar('servicios', $arrDatos)) {
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
?>

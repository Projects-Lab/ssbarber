<?php
require "../modelos/citas.modelo.php";

class ControladorCitas{

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

if(isset($_POST['metodo']) && $_POST['metodo'] == 'insertar'){
    parse_str($_POST['data'], $arrDatos);
    if($objeto::Insertar('citas', $arrDatos)){
        echo json_encode(["respuesta"=> true]);
    }else{
        echo json_encode(["respuesta"=> false]);
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
?>

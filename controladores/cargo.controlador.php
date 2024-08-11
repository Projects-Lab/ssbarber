<?php
require "../modelos/cargos.modelo.php";

class ControladorCargos{

    static public function Listar($tabla, $item, $valor)
    {
        return ModeloCargos::mdlListar($tabla, $item, $valor);
    }


    static public function Actualizar($tabla, $datos)
    {
        return ModeloCargos::mdlActualizar($tabla, $datos);
    }

    static public function Eliminar($id)
    {
        return ModeloCargos::mdlEliminar($id);
    }

    static public function Editar($id)
    {
        return ModeloCargos::mdObtener($id);
    }

    static public function Insertar($tabla,$datos){
        return ModeloCargos::mdlIngresar($tabla,$datos);
    }
}


$objeto = new ControladorCargos();

if (isset($_POST['metodo']) && $_POST['metodo'] == 'listar') {
    echo json_encode($objeto::Listar('cargo', '', ''));
}

if(isset($_POST['metodo']) && $_POST['metodo'] == 'insertar'){
    parse_str($_POST['data'], $arrDatos);
    if($objeto::Insertar('cargo',$arrDatos)){
        echo json_encode(["respuesta"=> true]);
    }else{
        echo json_encode(["respuesta"=> false]);
    }
    
}

 if (isset($_POST['metodo']) && $_POST['metodo'] == 'actualizar') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::Actualizar('cargo', $arrDatos)) {
        echo json_encode(["respuesta" => true] );
    } else {
        echo json_encode(["respuesta" => false] );
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

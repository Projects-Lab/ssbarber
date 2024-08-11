<?php
require_once '../modelos/productos.modelo.php';

class ControladorProductos
{

    static public function ctrListarProductos()
    {
        return ModeloProductos::mdlListarProductos();
    }

    static public function ctrAgregarProducto($datos)
    {
        return ModeloProductos::mdlRegistrarProducto($datos);
    }

    static public function ctrConsultarProducto($producto)
    {
        return ModeloProductos::mdlConsultarProducto($producto);
    }

    static public function ctrEditarProducto($id)
    {
        return ModeloProductos::mdlEditarProducto($id);
    }

    static public function ctrActualizarProducto($datos)
    {
        return ModeloProductos::mdlActualizarProducto($datos);
    }

    static public function ctrEliminarProducto($datos)
    {
        return ModeloProductos::mdlEliminarProducto($datos);
    }

    static public function ctrValidarProducto($codigo)
    {
        return ModeloProductos::mdlValidarProducto($codigo);
    }
}

$objeto = new ControladorProductos();

if ($_POST['metodo'] == 'validar_existencia') {
    $codigo = $_POST['codigo'];
    if ($objeto::ctrValidarProducto($codigo)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'consultar_producto') {
    $producto = $_POST['id_producto'];
    echo json_encode($objeto::ctrConsultarProducto($producto));
}

if ($_POST['metodo'] == 'editar_producto') {
    $producto = $_POST['id_producto'];
    echo json_encode($objeto::ctrEditarProducto($producto));
}

if ($_POST['metodo'] == 'agregar_producto') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrAgregarProducto($arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'actualizar_producto') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrActualizarProducto($arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'listar_productos') {
    $data = $objeto::ctrListarProductos();
    $results = [];
    $list = [];
    if (count($data) > 0) {
        foreach ($data as $value) {
            $list[] = [
                "nombre" => $value['nombre'],
                "codigo" => $value['codigo'],
                "categoria" => $value['categoria'],
                "stock" => $value['stock'],
                "precio" => $value['precio'],
                "op" => "
                    <button type='button' class='btn btn-primary btn-sm' title='Ver producto' onclick='VerProducto({$value['id']})'>
                        <i class='far fa-eye'></i>
                    </button>
                    <button type='button' class='btn btn-warning btn-sm' title='Editar producto' onclick='EditarProducto({$value['id']})'>
                        <i class='fas fa-edit text-white'></i>
                    </button>
                    <button type='button' class='btn btn-danger btn-sm'  title='Eliminar producto' onclick='EliminarProducto({$value['id']})'>
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

if ($_POST['metodo'] == 'eliminar_producto') {
    $producto = $_POST['id'];
    if ($objeto::ctrEliminarProducto($producto)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}
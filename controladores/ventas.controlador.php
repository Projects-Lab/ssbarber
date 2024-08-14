<?php

require_once '../modelos/ventas.modelo.php';
class ControladorVentas
{

    // Método para validar existencia de una venta
    public static function ctrValidarVenta($numero_venta)
    {
        return ModeloVentas::mdlValidarVenta($numero_venta);
    }

    static public function Imprimir($id)
    {
        return ModeloVentas::mdlConsultarVenta($id);
    }

    // Método para consultar una venta
    public static function ctrConsultarVenta($id_venta)
    {
        return ModeloVentas::mdlConsultarVenta($id_venta);
    }

    // Método para obtener datos para editar una venta
    public static function ctrEditarVenta($id_venta)
    {
        return ModeloVentas::mdlEditarVenta($id_venta);
    }

    // Método para agregar una nueva venta
    public static function ctrAgregarVenta($datos)
    {
        return ModeloVentas::mdlAgregarVenta($datos);
    }

    // Método para actualizar una venta existente
    public static function ctrActualizarVenta($datos)
    {
        return ModeloVentas::mdlActualizarVenta($datos);
    }

    // Método para listar todas las ventas
    public static function ctrListarVentas()
    {
        return ModeloVentas::mdlListarVentas();
    }

    // Método para eliminar una venta
    public static function ctrEliminarVenta($id)
    {
        return ModeloVentas::mdlEliminarVenta($id);
    }
    public static function ctrListarProductos()
    {
        return ModeloVentas::mdlListarProductos();
    }
    public static function ctrListarClientes()
    {
        return ModeloVentas::mdlListarClientes();
    }
}

$objeto = new ControladorVentas();

if ($_POST['metodo'] == 'listar_productos') {
    $productos = $objeto::ctrListarProductos();
    echo json_encode($productos);
}

if ($_POST['metodo'] == 'listar_clientes') {
    $clientes = $objeto::ctrListarClientes();
    echo json_encode($clientes);
}

if ($_POST['metodo'] == 'validar_existencia') {
    $numero_venta = $_POST['numero_venta'];
    if ($objeto::ctrValidarVenta($numero_venta)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'consultar_venta') {
    $venta = $_POST['id_venta'];
    echo json_encode($objeto::ctrConsultarVenta($venta));
}

if ($_POST['metodo'] == 'editar_venta') {
    $venta = $_POST['id_venta'];
    echo json_encode($objeto::ctrEditarVenta($venta));
}

if ($_POST['metodo'] == 'agregar_venta') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrAgregarVenta($arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'actualizar_venta') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrActualizarVenta($arrDatos)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

if ($_POST['metodo'] == 'listar_ventas') {
    $data = $objeto::ctrListarVentas();
    $results = [];
    $list = [];
    if (count($data) > 0) {
        foreach ($data as $value) {
            $list[] = [
                "fecha" => $value['fecha'],
                "consecutivo" => $value['consecutivo_venta'],
                "cedula_cliente" => $value['numero_identificacion'],
                "nombres_cliente" => $value['primer_nombre'] . ' ' . $value['segundo_nombre'] . ' ' . $value['primer_apellido'] . ' ' . $value['segundo_apellido'],
                "producto_nombre" => $value['producto_nombre'],
                "valor_venta" => $value['valor'],

                "op" => "
                    <button type='button' class='btn btn-primary btn-sm' title='Ver venta' onclick='VerVenta({$value['id']})'>
                        <i class='far fa-eye'></i>
                    </button>
                    <button type='button' class='btn btn-info btn-sm' title='Imprimir' onclick='imprimir({$value['id']})'>
                        <i class='fas fa-print'></i>
                    </button>
                    <button type='button' class='btn btn-warning btn-sm' hidden title='Editar venta' onclick='EditarVenta({$value['id']})'>
                        <i class='fas fa-edit text-white'></i>
                    </button>
                    <button type='button' class='btn btn-danger btn-sm' title='Eliminar venta' onclick='EliminarVenta({$value['id']})'>
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

if (isset($_POST['metodo']) && $_POST['metodo'] == 'imprimir') {
    $id = $_POST['id'];
    $registro = $objeto::Imprimir($id); // Cambiado a $registro en lugar de $registros
    $jsonData = json_encode($registro);
    
    // Guardar los datos en un archivo JSON
    $jsonDatos = json_encode($registro);
    file_put_contents('ventasdatos.json', $jsonDatos);
}


if ($_POST['metodo'] == 'eliminar_venta') {
    $venta = $_POST['id'];
    if ($objeto::ctrEliminarVenta($venta)) {
        echo json_encode(["respuesta" => true]);
    } else {
        echo json_encode(["respuesta" => false]);
    }
}

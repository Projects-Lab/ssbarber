<?php

require_once 'conexion.php';

class ModeloVentas
{

    public static function mdlValidarVenta($numero_venta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE consecutivo = :numero_venta");
        $stmt->bindParam(':numero_venta', $numero_venta, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public static function mdlListarProductos() {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM productos");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function mdlListarClientes() {
        $stmt = Conexion::conectar()->prepare("SELECT   c.numero_identificacion,                                                    
                                                        CONCAT(c.primer_nombre, ' ', c.segundo_nombre, ' ', c.primer_apellido, ' ', c.segundo_apellido) AS nombre_completo
                                                        FROM clientes c");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlConsultarVenta($id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT
    v.id,
    v.fecha,
    v.consecutivo_venta,
    v.valor,
    c.numero_identificacion,
    c.primer_nombre,
    c.segundo_nombre,
    c.primer_apellido,
    c.segundo_apellido,
    p.nombre as producto_nombre ,
    p.codigo as producto_codigo
    
FROM
    ventas v
INNER JOIN clientes c ON v.id_cliente = c.id
INNER JOIN productos p ON v.id_producto = p.id WHERE v.id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




    public static function mdlEditarVenta($id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function mdlAgregarVenta($datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO ventas (fecha, consecutivo_venta, id_cliente, id_producto, valor)

        VALUES (:fecha, :consecutivo_venta, :id_cliente, :id_producto, :valor)");
        
        $stmt->bindParam(':fecha', $datos['fechaVenta'], PDO::PARAM_STR);
        $stmt->bindParam(':consecutivo_venta', $datos['consecutivoVenta'], PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $datos['clienteVenta'], PDO::PARAM_STR);
        $stmt->bindParam(':id_producto', $datos['productoVenta'], PDO::PARAM_STR);
        $stmt->bindParam(':valor', $datos['valorVenta'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function mdlActualizarVenta($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE ventas SET fecha = :fecha, consecutivo_venta = :consecutivo_venta, id_cliente = :cedula_cliente, id_producto = :id_producto WHERE id = :id");
        $stmt->bindParam(':id', $datos['id'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $datos['fechaVenta_editar'], PDO::PARAM_STR);
        $stmt->bindParam(':consecutivo_venta', $datos['consecutivoVenta_editar'], PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $datos['clienteVenta_editar'], PDO::PARAM_STR);
        $stmt->bindParam(':id_producto', $datos['productoVenta_editar'], PDO::PARAM_STR);
        $stmt->bindParam(':valor', $datos['valorVenta_editar'], PDO::PARAM_STR);
        return $stmt->execute();
    }





    public static function mdlListarVentas()
    {
        $sql = 'SELECT
    v.id,
    v.fecha,
    v.consecutivo_venta,
    v.valor,
    c.numero_identificacion,
    c.primer_nombre,
    c.segundo_nombre,
    c.primer_apellido,
    c.segundo_apellido,
    p.nombre as producto_nombre ,
    p.codigo as producto_codigo
    
FROM
    ventas v
INNER JOIN clientes c ON v.id_cliente = c.id
INNER JOIN productos p ON v.id_producto = p.id';

        $stmt = Conexion::conectar()->query($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }


    public static function mdlEliminarVenta($id)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM ventas WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

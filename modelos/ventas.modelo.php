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
        $stmt = Conexion::conectar()->prepare("INSERT INTO ventas (fecha, consecutivo, cedula_cliente, nombres_cliente, apellidos_cliente, producto_nombre, producto_codigo, producto_valor) VALUES (:fecha, :consecutivo, :cedula_cliente, :nombres_cliente, :apellidos_cliente, :producto_nombre, :producto_codigo, :producto_valor)");
        $stmt->bindParam(':fecha', $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(':consecutivo', $datos['consecutivo'], PDO::PARAM_STR);
        $stmt->bindParam(':cedula_cliente', $datos['cedula_cliente'], PDO::PARAM_STR);
        $stmt->bindParam(':nombres_cliente', $datos['nombres_cliente'], PDO::PARAM_STR);
        $stmt->bindParam(':apellidos_cliente', $datos['apellidos_cliente'], PDO::PARAM_STR);
        $stmt->bindParam(':producto_nombre', $datos['producto_nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':producto_codigo', $datos['producto_codigo'], PDO::PARAM_STR);
        $stmt->bindParam(':producto_valor', $datos['producto_valor'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function mdlActualizarVenta($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE ventas SET fecha = :fecha, consecutivo = :consecutivo, cedula_cliente = :cedula_cliente, nombres_cliente = :nombres_cliente, apellidos_cliente = :apellidos_cliente, producto_nombre = :producto_nombre, producto_codigo = :producto_codigo, producto_valor = :producto_valor WHERE id = :id");
        $stmt->bindParam(':id', $datos['id'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(':consecutivo', $datos['consecutivo'], PDO::PARAM_STR);
        $stmt->bindParam(':cedula_cliente', $datos['cedula_cliente'], PDO::PARAM_STR);
        $stmt->bindParam(':nombres_cliente', $datos['nombres_cliente'], PDO::PARAM_STR);
        $stmt->bindParam(':apellidos_cliente', $datos['apellidos_cliente'], PDO::PARAM_STR);
        $stmt->bindParam(':producto_nombre', $datos['producto_nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':producto_codigo', $datos['producto_codigo'], PDO::PARAM_STR);
        $stmt->bindParam(':producto_valor', $datos['producto_valor'], PDO::PARAM_STR);
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

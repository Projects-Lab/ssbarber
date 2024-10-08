<?php
require_once "conexion.php";

class ModeloProductos
{
    static public function mdlListarProductos()
    {
        $sql = 'SELECT
                    p.id AS id,
                    p.nombre AS nombre,
                    p.codigo AS codigo,
                    ct.nombre AS categoria,
                    p.precio as precio,
                    p.stock as stock
                FROM
                productos p,
                categorias ct
                ORDER BY p.nombre ASC';
        $stmt = Conexion::conectar()->query($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }
    static public function mdlConsultarProducto($id)
    {
        $sql = "SELECT
                    p.id AS id,
                    p.nombre AS nombre,
                    p.codigo AS codigo,
                    ct.nombre AS categoria,
                    p.precio as precio,
                    p.stock as stock
                FROM
                productos p,
                categorias ct
            WHERE p.id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlRegistrarProducto($datos)
    {
        $sql = "INSERT INTO productos(nombre, codigo, categoria_id, stock, precio) 
                VALUES (:nombre, :codigo, :categoria_id, :stock, :precio)";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":nombre", $datos['nombreProducto'], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos['codigoProducto'], PDO::PARAM_STR);
        $stmt->bindParam(":categoria_id", $datos['categoriaProducto'], PDO::PARAM_INT);
        $stmt->bindParam(":stock", $datos['stockProducto'], PDO::PARAM_INT);
        $stmt->bindParam(":precio", $datos['precioProducto'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt = null;
    }

    static public function mdlActualizarProducto($datos)
    {
        $sql = "UPDATE productos SET nombre=:nombre, codigo=:codigo, categoria_id=:categoria, 
                        stock=:stock, precio=:precio 
                WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":nombre", $datos['editarNombreProducto'], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos['editarCodigoProducto'], PDO::PARAM_STR);
        $stmt->bindParam(":categoria", $datos['editarCategoriaProducto'], PDO::PARAM_INT);
        $stmt->bindParam(":stock", $datos['editarStockProducto'], PDO::PARAM_INT);
        $stmt->bindParam(":precio", $datos['editarPrecioProducto'], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos['idProductoEditar'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt = null;
    }

    static public function mdlEditarProducto($id)
    {
        $sql = "SELECT
                    p.id AS id,
                    p.nombre AS nombre,
                    p.codigo AS codigo,
                    ct.nombre AS categoria,
                    p.precio as precio,
                    p.stock as stock
                FROM
                productos p,
                categorias ct
                where  p.id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlEliminarProducto($id)
    {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt = null;
    }

    static public function mdlValidarProducto($codigo_producto)
    {
        $sql = "SELECT * FROM productos WHERE codigo = :codigoProducto";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":codigoProducto", $codigo_producto, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
        $stmt = null;
    }

    static public function mdlInfoProductoVenta($id)
    {
        $sql = "SELECT
                    *
                FROM
                productos p
                where  p.id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }

}

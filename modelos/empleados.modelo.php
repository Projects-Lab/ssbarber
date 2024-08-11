<?php

require_once "conexion.php";

class ModeloEmpleados
{
    // Método para agregar un empleado
    public static function mdlAgregarEmpleado($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO empleado (nombre, cargo_id) VALUES (:nombre, :cargo_id)");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":cargo_id", $datos["cargo_id"], PDO::PARAM_INT);

        return $stmt->execute() ? true : false;
    }

    // Método para consultar un empleado
    public static function mdlConsultarEmpleado($id_empleado)
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT e.id, e.nombre, e.cargo_id, c.nombre as cargo 
            FROM empleado e 
            JOIN cargo c ON e.cargo_id = c.id 
            WHERE e.id = :id_empleado
        ");
        $stmt->bindParam(":id_empleado", $id_empleado, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para actualizar un empleado
    public static function mdlActualizarEmpleado($datos)
    {
        $stmt = Conexion::conectar()->prepare("
            UPDATE empleado 
            SET nombre = :nombre, cargo_id = :cargo_id 
            WHERE id = :id_empleado
        ");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":cargo_id", $datos["cargo_id"], PDO::PARAM_INT);
        $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_INT);

        return $stmt->execute() ? true : false;
    }

    // Método para listar todos los empleados
    public static function mdlListarEmpleados()
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT e.id, e.nombre, c.nombre as cargo 
            FROM empleado e 
            JOIN cargo c ON e.cargo_id = c.id
        ");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para eliminar un empleado
    public static function mdlEliminarEmpleado($id_empleado)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM empleado WHERE id = :id_empleado");
        $stmt->bindParam(":id_empleado", $id_empleado, PDO::PARAM_INT);

        return $stmt->execute() ? true : false;
    }
}

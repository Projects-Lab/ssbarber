<?php
require_once "conexion.php";

class ModeloCitas
{

    static public function mdlListar($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT
                                                    ct.id,
                                                    c.numero_identificacion,
                                                    ct.fecha_asignada,
                                                    ct.hora_asignada,
                                                    CONCAT(c.primer_nombre, ' ', c.segundo_nombre) AS nombre_completo,
                                                    CONCAT(c.primer_apellido, ' ', c.segundo_apellido) AS apellido_completo,
                                                    e.nombre as nombre_empleado,
                                                    s.nombre as nombre_servicio,
                                                    ct.estado
                                              FROM
                                                    $tabla ct
                                                INNER JOIN empleado e ON ct.id_empleado = e.id
                                                INNER JOIN servicios s ON ct.id_servicio = s.id
                                                INNER JOIN clientes c ON ct.id_cliente = c.id");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt = null;
    }

    static public function mdlIngresar($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha_cita, hora_cita, id_cliente, nombre_cliente, apellidos_cliente, estudio, empleado) VALUES (:fecha_cita, :hora_cita, :id_cliente, :nombre_cliente, :apellidos_cliente, :estudio, :empleado)");
        $stmt->bindParam(":fecha_cita", $datos["fecha_cita"], PDO::PARAM_STR);
        $stmt->bindParam(":hora_cita", $datos["hora_cita"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos_cliente", $datos["apellidos_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":estudio", $datos["estudio"], PDO::PARAM_STR);
        $stmt->bindParam(":empleado", $datos["empleado"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    static public function mdlActualizar($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_cita=:fecha_cita, hora_cita=:hora_cita, id_cliente=:id_cliente, nombre_cliente=:nombre_cliente, apellidos_cliente=:apellidos_cliente, estudio=:estudio, empleado=:empleado WHERE id=:id");

        $stmt->bindParam(":id", $datos["idcita"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_cita", $datos["fecha_cita"], PDO::PARAM_STR);
        $stmt->bindParam(":hora_cita", $datos["hora_cita"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos_cliente", $datos["apellidos_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":estudio", $datos["estudio"], PDO::PARAM_STR);
        $stmt->bindParam(":empleado", $datos["empleado"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    static public function mdObtener($id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT
                                                    ct.id,
                                                    c.numero_identificacion,
                                                    ct.fecha_asignada,
                                                    ct.hora_asignada,
                                                    CONCAT(c.primer_nombre, ' ', c.segundo_nombre) AS nombre_completo,
                                                    CONCAT(c.primer_apellido, ' ', c.segundo_apellido) AS apellido_completo,
                                                    e.nombre as nombre_empleado,
                                                    s.nombre as nombre_servicio,
                                                    ct.estado
                                              FROM
                                                    citas ct
                                                INNER JOIN empleado e ON ct.id_empleado = e.id
                                                INNER JOIN servicios s ON ct.id_servicio = s.id
                                                INNER JOIN clientes c ON ct.id_cliente = c.id
                                              WHERE
                                                    ct.id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlEliminar($id)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM citas WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }
}

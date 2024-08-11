<?php
require_once "conexion.php";

class ModeloServicios {

    static public function mdlListar($tabla, $item, $valor) {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt = null;
    }

    static public function mdlIngresar($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nuevoNombre)");
        $stmt->bindParam(":nuevoNombre", $datos["nuevoNombre"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    static public function mdlActualizar($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:editarNombre WHERE id=:id");
        $stmt->bindParam(":id", $datos["idservicio"], PDO::PARAM_INT);
        $stmt->bindParam(":editarNombre", $datos["editarNombre"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    static public function mdlObtener($id) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM servicios WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlEliminar($id) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM servicios WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0 ? "ok" : "error";
        $stmt = null;
    }
}
?>

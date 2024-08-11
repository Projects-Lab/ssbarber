<?php
require_once "conexion.php";
class ModeloUsuarios
{
	static public function mdlMostrarUsuarios($tabla, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT id, password, nombre, usuario, perfil, estado, fecha FROM $tabla WHERE $item = :$item ");
			$stmt->bindParam(":" . $item, $valor);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT id, nombre, usuario, perfil, estado, fecha FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		$stmt = null;
	}

	static public function mdlIngresarUsuario($tabla, $datos)
	{
		//ESTOS CAMPOS DEBEN TENER LOS MISMO NOMBRES DE LA BASE DE DATOS
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,usuario, password, perfil) 
		VALUES (:nombre,:usuario, :password, :perfil)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
		$stmt = null;
	}

	static public function mdlActualizarUsuario($tabla, $datos)
	{
		$sql = "UPDATE $tabla SET nombre = :nombre, usuario = :usuario, perfil = :perfil, estado = :estado WHERE id = :id";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":nombre", $datos["nuevoNombre_u"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["nuevoUsuario_u"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["nuevoPerfil_u"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["nuevoEstado_u"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["usuario_id"], PDO::PARAM_INT);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
		$stmt = null;
	}
	
	static public function mdlEliminarUsuario($tabla, $usuario_id)
	{
		$sql = "DELETE FROM $tabla WHERE id = :id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":id", $usuario_id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
		$stmt = null;
	}
}

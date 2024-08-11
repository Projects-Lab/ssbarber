<?php
session_start();
require "../modelos/usuarios.modelo.php";
class ControladorUsuarios
{
    static public function ctrIngresoUsuario($usuario, $clave)
    {
        if ($usuario !== "") {
            if (preg_match('/^[a-zA-Z0-9]+$/', $usuario)) {
                $encriptar = crypt($clave, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $tabla = "usuarios";

                $item = "usuario";
                $valor = $usuario;

                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
                if ($respuesta["usuario"] == $usuario && $respuesta["password"] == $encriptar) {
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta["id"];
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    $_SESSION["usuario"] = $respuesta["usuario"];
                    $_SESSION["perfil"] = $respuesta["perfil"];
                    return true;
                } else {
                   return false;
                }
            }
        }
    }

    static public function ctrCrearUsuario($nombre, $rol, $usuario, $clave)
    {
        if (
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre) &&
            preg_match('/^[a-zA-Z0-9]+$/', $rol) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $usuario) &&
            preg_match('/^[a-zA-Z0-9]+$/', $clave)
        ) {
            $tabla = "usuarios";
            $encriptar = crypt($clave, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $datos = [
                "nombre" => $nombre,
                "usuario" => $usuario,
                "password" => $encriptar,
                "perfil" => $rol
            ];

            $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
            if ($respuesta) {
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    static public function ctrMostrarUsuarios($item, $valor)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrActualizarUsuarios($datos)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $datos);
        return $respuesta;

    }

    static public function ctrEliminarUsuarios($datos)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla, $datos);
        return $respuesta;

    }
}

$objeto = new ControladorUsuarios;

if (isset($_POST['metodo']) && $_POST['metodo'] == 'listar') {
    $data = $objeto::ctrMostrarUsuarios('', '');
    $results = [];
    $list = [];
    if (count($data) > 0) {
        foreach ($data as $value) {
            $list[] = [
                "NOMBRE" => $value['nombre'],
                "USUARIO" => $value['usuario'],
                "PERFIL" => $value['perfil'],
                "ESTADO" => $value['estado'],
                "REGISTRO" => $value['fecha'],
                "OP" => "
                    <button type='button' class='btn btn-secondary btn-sm' title='Editar usuario' onclick='editar({$value['id']})'>
                        <i class='fas fa-user-edit'></i>
                    </button>
                    <button type='button' class='btn btn-warning btn-sm' title='Cambiar clave' onclick='cambiarClave({$value['id']})'>
                        <i class='fa fa-key'></i>
                    </button>
                    <button type='button' class='btn btn-danger btn-sm' title='Eliminar usuario' onclick='eliminar({$value['id']})'>
                        <i class='fas fa-trash'></i>
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

if (isset($_POST['metodo']) && $_POST['metodo'] == 'ingresar') {
    parse_str($_POST['data'], $arrDatos);
    echo json_encode($objeto::ctrIngresoUsuario($arrDatos["ingUsuario"], $arrDatos["ingPassword"]));
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'insertar') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrCrearUsuario($arrDatos["nuevoNombre"], $arrDatos["nuevoPerfil"], $arrDatos["nuevoUsuario"], $arrDatos["nuevoPassword"])) {
        echo json_encode(["response" => true]);
    }else{
        echo json_encode(["response" => false]);
    }
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'editar') {
    $usuario_id = $_POST['usuario_id'];
    echo json_encode($objeto::ctrMostrarUsuarios('id', $usuario_id));
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'actualizar') {
    parse_str($_POST['data'], $arrDatos);
    if ($objeto::ctrActualizarUsuarios($arrDatos)) {
        echo json_encode(["response" => true]);
    }else{
        echo json_encode(["response" => false]);
    }
}

if (isset($_POST['metodo']) && $_POST['metodo'] == 'eliminar') {
    $usuario_id = $_POST['usuario_id'];
    if ($objeto::ctrEliminarUsuarios($usuario_id)) {
        echo json_encode(["response" => true]);
    }else{
        echo json_encode(["response" => false]);
    }
}
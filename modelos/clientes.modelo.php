<?php
require_once "conexion.php";
class ModeloPacientes
{
    static public function mdlListarTipoDocumento()
    {
        $sql = "SELECT id, codigo, descripcion FROM tipo_documento";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlListarDepartamento()
    {
        $sql = "SELECT id_departamento, departamento FROM departamentos";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlListarMunicipio($departamento)
    {
        $sql = "SELECT * FROM municipios WHERE departamento_id = :departamento";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":departamento", $departamento, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlListarPacientes()
    {
        $sql = 'SELECT 
                    p.id, td.descripcion, p.numero_identificacion, p.primer_nombre,
                     p.segundo_nombre, p.primer_apellido, p.segundo_apellido, 
                    p.telefono_1
                FROM clientes p
                INNER JOIN tipo_documento td ON p.tipo_documento_id = td.id
                ORDER BY p.primer_nombre asc';
        $stmt = Conexion::conectar()->query($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlConsultarPaciente($id)
    {
        $sql = "SELECT 
                td.descripcion AS ti,
                p.numero_identificacion AS numero,
                p.primer_nombre AS primer_nombre,
                p.segundo_nombre AS segundo_nombre,
                p.primer_apellido AS primer_apellido,
                p.segundo_apellido AS segundor_apellido,
                case when p.sexo = 'M' then 'MASCULINO' ELSE 'FEMENINO' END AS sexo,
                p.fecha_nacimiento AS fecha_nacimiento,
                p.edad AS edad,
                p.telefono_1 AS celular,
                d.departamento AS departamento_paciente,
                m.municipio AS municipio_paciente,
                p.direccion_residencia AS direccion_residencia
            FROM
                clientes p
            INNER JOIN tipo_documento td ON p.tipo_documento_id = td.id
            INNER JOIN departamentos d ON p.id_departamento = d.id_departamento
            INNER JOIN municipios m ON p.id_municipio = m.id_municipio
            WHERE p.id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlRegistrarPaciente($datos)
    {
        $sql = "INSERT INTO clientes(tipo_documento_id, numero_identificacion, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, 
                            sexo, fecha_nacimiento, edad, telefono_1, direccion_residencia, id_municipio, id_departamento) 
                VALUES (:tipo_documento_id, :numero_identificacion, :primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, 
                            :sexo, :fecha_nacimiento, :edad, :telefono_1, :direccion_residencia, :id_municipio, :id_departamento)";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":tipo_documento_id", $datos['tipoDocumentoPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":numero_identificacion", $datos['identificacionPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":primer_nombre", $datos['primerNombrePaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":segundo_nombre", $datos['segundoNombrePaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":primer_apellido", $datos['primerApellidoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":segundo_apellido", $datos['segundoApellidoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $datos['generoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos['fechaNacimientoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":edad", $datos['edadPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":telefono_1", $datos['celularPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":direccion_residencia", $datos['direccionResidenciaPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":id_municipio", $datos['municipioPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":id_departamento", $datos['departamentoPaciente'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt = null;
    }

    static public function mdlActualizarPaciente($datos)
    {
        $sql = "UPDATE clientes SET tipo_documento_id=:tipo_documento_id,numero_identificacion=:numero_identificacion,
                        primer_nombre=:primer_nombre,segundo_nombre=:segundo_nombre,primer_apellido=:primer_apellido,segundo_apellido=:segundo_apellido,
                        sexo=:sexo,fecha_nacimiento=:fecha_nacimiento,edad=:edad, telefono_1=:telefono_1, direccion_residencia=:direccion_residencia,
                        id_municipio=:id_municipio,id_departamento=:id_departamento WHERE id = :id";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":tipo_documento_id", $datos['tipoDocumentoPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":numero_identificacion", $datos['identificacionPaciente_editar'], PDO::PARAM_STR);
        $stmt->bindParam(":primer_nombre", $datos['primerNombrePaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":segundo_nombre", $datos['segundoNombrePaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":primer_apellido", $datos['primerApellidoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":segundo_apellido", $datos['segundoApellidoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $datos['generoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos['fechaNacimientoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":edad", $datos['edadPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":telefono_1", $datos['celularPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_residencia", $datos['direccionResidenciaPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":id_municipio", $datos['municipioPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":id_departamento", $datos['departamentoPaciente_editar'], PDO::PARAM_INT);

        $stmt->bindParam(":id", $datos['id_paciente_editar'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt = null;
    }

    static public function mdlEditarPaciente($id)
    {
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlEliminarPaciente($id)
    {
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt = null;
    }

    static public function mdlValidarPaciente($numero_identificacion)
    {
        $sql = "SELECT * FROM clientes  WHERE numero_identificacion = :identificacionPaciente";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":identificacionPaciente", $numero_identificacion, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        $stmt = null;
    }
}

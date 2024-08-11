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

    static public function mdlListarAseguradora()
    {
        $sql = "SELECT * FROM aseguradora";
        $stmt = Conexion::conectar()->query($sql);
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
                    p.id, td.descripcion, 
                    p.numero_identificacion, 
                    p.primer_nombre,
                     p.segundo_nombre,             
                     p.primer_apellido, 
                     p.segundo_apellido, 
                    p.telefono_1, 
                    p.registro
                FROM paciente p
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
                p.estado_civil AS estado_civil,
                p.ocupacion AS ocupacion,
                p.telefono_1 AS celular,
                p.telefono_2 AS telefono,
                p.responsable AS responsable,
                p.parentesco_responsable AS parentezco_responsable,
                p.telefono_parentesco AS parentezco_telefono,
                p.responsable_2 AS responsable_avisar,
                p.telefono_responsable_2 AS responsable_avisar_telefono,
                d.departamento AS departamento_paciente,
                m.municipio AS municipio_paciente,
                case when p.zona_paciente = 'U' then 'URBANA' ELSE 'RURAL' END AS zona_ubicacion_paciente,
                p.direccion_residencia AS direccion_residencia,
                a.nombre AS asegurado_paciente,
                e.nombre AS eps_paciente,
                p.antecedentes_alergia AS antecedentes_alergia,
                p.antecedentes_patologico AS antecedentes_patologico,
                p.antecedentes_medicacion AS antecedentes_medicacion,
                p.antecedentes_liqali AS antecedentes_liqali
            FROM
                paciente p
            INNER JOIN tipo_documento td ON p.tipo_documento_id = td.id
            INNER JOIN aseguradora a ON p.aseguradora_id = a.id
            INNER JOIN eps e ON p.id_eps = e.id
            INNER JOIN departamentos d ON p.id_departamento = d.id_departamento
            INNER JOIN municipios m ON p.id_municipio = m.id_municipio
            WHERE p.id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlAgregarAseguradora($nombre)
    {
        $sql = "INSERT INTO aseguradora(nombre) VALUES (:nombre)";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        $stmt = null;
    }

    static public function mdlRegistrarPaciente($datos)
    {
        $sql = "INSERT INTO paciente(tipo_documento_id, numero_identificacion, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, 
                            sexo, fecha_nacimiento, edad, estado_civil, ocupacion, telefono_1, telefono_2, direccion_residencia, zona_paciente, id_municipio, 
                            id_departamento, responsable, parentesco_responsable, telefono_parentesco, responsable_2, telefono_responsable_2, 
                            aseguradora_id, antecedentes_alergia, antecedentes_patologico, antecedentes_medicacion, antecedentes_liqali, id_eps) 
                VALUES (:tipo_documento_id, :numero_identificacion, :primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, 
                            :sexo, :fecha_nacimiento, :edad, :estado_civil, :ocupacion, :telefono_1, :telefono_2, :direccion_residencia, :zona_paciente, :id_municipio, 
                            :id_departamento, :responsable, :parentesco_responsable, :telefono_parentesco, :responsable_2, :telefono_responsable_2, 
                            :aseguradora_id, :antecedentes_alergia, :antecedentes_patologico, :antecedentes_medicacion, :antecedentes_liqali, :id_eps)";

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
        $stmt->bindParam(":estado_civil", $datos['estadoCivilPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":ocupacion", $datos['pacienteOcupacion'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_1", $datos['celularPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":telefono_2", $datos['telefonoPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":direccion_residencia", $datos['direccionResidenciaPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":zona_paciente", $datos['zonaPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":id_municipio", $datos['municipioPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":id_departamento", $datos['departamentoPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":responsable", $datos['acompanantePaciente'], PDO::PARAM_STR);

        $stmt->bindParam(":parentesco_responsable", $datos['parentezcoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_parentesco", $datos['telefonoacompañante'], PDO::PARAM_INT);
        $stmt->bindParam(":responsable_2", $datos['avisarPaciente'], PDO::PARAM_STR);

        $stmt->bindParam(":telefono_responsable_2", $datos['celularAvisar'], PDO::PARAM_INT);
        $stmt->bindParam(":aseguradora_id", $datos['aseguradoraPaciente'], PDO::PARAM_INT);

        $stmt->bindParam(":antecedentes_alergia", $datos['alergiaPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":antecedentes_patologico", $datos['patologicoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":antecedentes_medicacion", $datos['medicacionPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":antecedentes_liqali", $datos['liquidosAlimentosPaciente'], PDO::PARAM_STR);

        $stmt->bindParam(":id_eps", $datos['epsPaciente'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt = null;
    }

    static public function mdlActualizarPaciente($datos)
    {
        $sql = "UPDATE paciente SET tipo_documento_id=:tipo_documento_id,numero_identificacion=:numero_identificacion,
                        primer_nombre=:primer_nombre,segundo_nombre=:segundo_nombre,primer_apellido=:primer_apellido,segundo_apellido=:segundo_apellido,
                        sexo=:sexo,fecha_nacimiento=:fecha_nacimiento,edad=:edad,estado_civil=:estado_civil,ocupacion=:ocupacion,
                        telefono_1=:telefono_1,telefono_2=:telefono_2,direccion_residencia=:direccion_residencia,zona_paciente=:zona_paciente,
                        id_municipio=:id_municipio,id_departamento=:id_departamento,responsable=:responsable,parentesco_responsable=:parentesco_responsable,
                        telefono_parentesco=:telefono_parentesco,responsable_2=:responsable_2,telefono_responsable_2=:telefono_responsable_2,
                        aseguradora_id=:aseguradora_id,antecedentes_alergia=:antecedentes_alergia,antecedentes_patologico=:antecedentes_patologico,
                        antecedentes_medicacion=:antecedentes_medicacion,antecedentes_liqali=:antecedentes_liqali,id_eps=:id_eps WHERE id = :id";

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
        $stmt->bindParam(":estado_civil", $datos['estadoCivilPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":ocupacion", $datos['pacienteOcupacion'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_1", $datos['celularPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_2", $datos['telefonoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_residencia", $datos['direccionResidenciaPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":zona_paciente", $datos['zonaPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":id_municipio", $datos['municipioPaciente'], PDO::PARAM_INT);
        $stmt->bindParam(":id_departamento", $datos['departamentoPaciente_editar'], PDO::PARAM_INT);
        $stmt->bindParam(":responsable", $datos['acompanantePaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":parentesco_responsable", $datos['parentezcoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_parentesco", $datos['telefonoAcomp'], PDO::PARAM_STR);
        $stmt->bindParam(":responsable_2", $datos['avisarPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_responsable_2", $datos['celularAvisar'], PDO::PARAM_STR);
        $stmt->bindParam(":aseguradora_id", $datos['aseguradoraPaciente'], PDO::PARAM_INT);

        $stmt->bindParam(":antecedentes_alergia", $datos['alergiaPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":antecedentes_patologico", $datos['patologicoPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":antecedentes_medicacion", $datos['medicacionPaciente'], PDO::PARAM_STR);
        $stmt->bindParam(":antecedentes_liqali", $datos['liquidosAlimentosPaciente'], PDO::PARAM_STR);

        $stmt->bindParam(":id_eps", $datos['epsPaciente'], PDO::PARAM_INT);

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
        $sql = "SELECT * FROM paciente WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }
    
    static public function mdlEliminarPaciente($id)
    {
        $sql = "DELETE FROM paciente WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }else{
            return false;
        }
        $stmt = null;
    }
    
        static public function mdlValidarPaciente($numero_identificacion)
    {
        $sql = "SELECT * FROM paciente  WHERE numero_identificacion = :identificacionPaciente";
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

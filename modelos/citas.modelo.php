<?php
require_once "conexion.php";

class ModeloCitas
{


    static public function mdlListarMedicos()
    {
        $sql = "SELECT * FROM medicos";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlListarEstudios()
    {
        $sql = "SELECT * FROM estudios";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    static public function mdlListarCitas()
    {
        $sql = "SELECT 
        c.fecha_asignada AS fechaAsignada,
        c.hora_asignada as horaCita,
        p.numero_identificacion AS idPaciente,
        CONCAT(p.primer_nombre, ' ', p.primer_apellido) AS paciente,
        e.nombreEstudio AS estudio,
        CONCAT(m.nombres, ' ', m.apellidos) AS medico,
        c.estado as estadoCita    
    FROM 
        citas c
    INNER JOIN paciente p ON c.id_paciente = p.id
    INNER JOIN medicos m ON c.id_medico = m.id
    INNER JOIN estudios e ON c.id_estudio = e.id
    ORDER BY 
        c.fecha_asignada";
        $stmt = Conexion::conectar()->query($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }
}

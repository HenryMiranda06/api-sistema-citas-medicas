<?php

require_once "config/Conexion.php";
require_once "models/Pacientes.php";

class PacientesDAO
{
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function listar()
    {
        try {
            $query = "SELECT pa.*, pe.cedula, pe.nombres, pe.apellidos, pe.correo, pe.telefono, pe.fechaNacimiento, pe.direccion
                    FROM pacientes pa
                    INNER JOIN personas pe ON pa.idPersona = pe.idPersona";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute();
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorId($idPaciente)
    {
        try {
            $query = "SELECT pa.*, pe.cedula, pe.nombres, pe.apellidos, pe.correo, pe.telefono, pe.fechaNacimiento, pe.direccion
                    FROM pacientes pa
                    INNER JOIN personas pe ON pa.idPersona = pe.idPersona
                    WHERE pa.idPaciente = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idPaciente]);
            return $preparado->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function registrar(Pacientes $paciente)
    {
        try {
            $query = "INSERT INTO pacientes (idPersona, tipoSangre, alergias, enfermedadesCronicas, antecedentes, estado)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $paciente->getIdPersona(),
                $paciente->getTipoSangre(),
                $paciente->getAlergias(),
                $paciente->getEnfermedadesCronicas(),
                $paciente->getAntecedentes(),
                $paciente->getEstado()
            ]);

            return [
                "success" => true,
                "message" => "Paciente registrado correctamente.",
                "idPaciente" => $this->conexion->lastInsertId()
            ];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function actualizar(Pacientes $paciente)
    {
        try {
            $query = "UPDATE pacientes SET idPersona = ?, tipoSangre = ?, alergias = ?, enfermedadesCronicas = ?, antecedentes = ?, estado = ?
                    WHERE idPaciente = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $paciente->getIdPersona(),
                $paciente->getTipoSangre(),
                $paciente->getAlergias(),
                $paciente->getEnfermedadesCronicas(),
                $paciente->getAntecedentes(),
                $paciente->getEstado(),
                $paciente->getIdPaciente()
            ]);

            return ["success" => true, "message" => "Paciente actualizado correctamente."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function eliminar($idPaciente)
    {
        try {
            $query = "DELETE FROM pacientes WHERE idPaciente = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idPaciente]);

            return ["success" => true, "message" => "Paciente eliminado correctamente."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}

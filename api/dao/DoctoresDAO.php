<?php

require_once "config/Conexion.php";
require_once "models/Doctores.php";

class DoctoresDAO
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
            $query = "SELECT d.*, pe.cedula, pe.nombres, pe.apellidos, pe.correo, pe.telefono, e.nombre AS especialidad
                    FROM doctores d
                    INNER JOIN personas pe ON d.idPersona = pe.idPersona
                    INNER JOIN especialidades e ON d.idEspecialidad = e.idEspecialidad";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute();
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorId($idDoctor)
    {
        try {
            $query = "SELECT d.*, pe.cedula, pe.nombres, pe.apellidos, pe.correo, pe.telefono, e.nombre AS especialidad
                    FROM doctores d
                    INNER JOIN personas pe ON d.idPersona = pe.idPersona
                    INNER JOIN especialidades e ON d.idEspecialidad = e.idEspecialidad
                    WHERE d.idDoctor = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idDoctor]);
            return $preparado->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function registrar(Doctores $doctor)
    {
        try {
            $query = "INSERT INTO doctores (idPersona, idEspecialidad, numeroLicencia, estado)
                    VALUES (?, ?, ?, ?)";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $doctor->getIdPersona(),
                $doctor->getIdEspecialidad(),
                $doctor->getNumeroLicencia(),
                $doctor->getEstado()
            ]);

            return [
                "success" => true,
                "message" => "Doctor registrado correctamente.",
                "idDoctor" => $this->conexion->lastInsertId()
            ];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function actualizar(Doctores $doctor)
    {
        try {
            $query = "UPDATE doctores SET idPersona = ?, idEspecialidad = ?, numeroLicencia = ?, estado = ?
                    WHERE idDoctor = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $doctor->getIdPersona(),
                $doctor->getIdEspecialidad(),
                $doctor->getNumeroLicencia(),
                $doctor->getEstado(),
                $doctor->getIdDoctor()
            ]);

            return ["success" => true, "message" => "Doctor actualizado correctamente."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function eliminar($idDoctor)
    {
        try {
            $query = "DELETE FROM doctores WHERE idDoctor = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idDoctor]);

            return ["success" => true, "message" => "Doctor eliminado correctamente."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}

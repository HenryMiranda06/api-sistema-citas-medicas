<?php

require_once "config/Conexion.php";
require_once "models/Pacientes.php";

class PacientesDAO{
    private $conexion;

    public function __construct(){
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function listar(){
        try{
            $query = "SELECT * FROM Pacientes";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute();
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorId($idPaciente){
        try{
            $query = "SELECT * FROM Pacientes WHERE idPaciente = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idPaciente]);
            return $preparado->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function registrar(Pacientes $paciente){
        try{
            $query = "INSERT INTO Pacientes (idUsuario, cedula, nombre, telefono, fechaNacimiento, direccion)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $paciente->getIdUsuario(),
                $paciente->getCedula(),
                $paciente->getNombre(),
                $paciente->getTelefono(),
                $paciente->getFechaNacimiento(),
                $paciente->getDireccion()
            ]);
            return ["success" => true, "message" => "Paciente registrado correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function actualizar(Pacientes $paciente){
        try{
            $query = "UPDATE Pacientes SET idUsuario = ?, cedula = ?, nombre = ?, telefono = ?, fechaNacimiento = ?, direccion = ?
                    WHERE idPaciente = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $paciente->getIdUsuario(),
                $paciente->getCedula(),
                $paciente->getNombre(),
                $paciente->getTelefono(),
                $paciente->getFechaNacimiento(),
                $paciente->getDireccion(),
                $paciente->getIdPaciente()
            ]);
            return ["success" => true, "message" => "Paciente actualizado correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function eliminar($idPaciente){
        try{
            $query = "DELETE FROM Pacientes WHERE idPaciente = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idPaciente]);
            return ["success" => true, "message" => "Paciente eliminado correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
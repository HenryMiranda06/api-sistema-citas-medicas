<?php

require_once "config/Conexion.php";
require_once "models/Doctores.php";

class DoctoresDAO{
    private $conexion;

    public function __construct(){
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function listar(){
        try{
            $query = "SELECT * FROM doctores";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute();
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorId($idDoctor){
        try{
            $query = "SELECT * FROM doctores WHERE idDoctor = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idDoctor]);
            return $preparado->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function registrar(Doctores $doctor){
        try{
            $query = "INSERT INTO doctores (idUsuario, idEspecialidad, cedula, nombre, telefono, correo)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $doctor->getIdUsuario(),
                $doctor->getIdEspecialidad(),
                $doctor->getCedula(),
                $doctor->getNombre(),
                $doctor->getTelefono(),
                $doctor->getCorreo()
            ]);
            return ["success" => true, "message" => "Doctor registrado correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function actualizar(Doctores $doctor){
        try{
            $query = "UPDATE doctores SET idUsuario = ?, idEspecialidad = ?, cedula = ?, nombre = ?, telefono = ?, correo = ?
                    WHERE idDoctor = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $doctor->getIdUsuario(),
                $doctor-> getIdEspecialidad(),
                $doctor->getCedula(),
                $doctor->getNombre(),
                $doctor->getTelefono(),
                $doctor->getCorreo(),
                $doctor->getIdDoctor()
            ]);
            return ["success" => true, "message" => "Doctor actualizado correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function eliminar($idDoctor){
        try{
            $query = "DELETE FROM doctores WHERE idDoctor = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idDoctor]);
            return ["success" => true, "message" => "Doctor eliminado correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
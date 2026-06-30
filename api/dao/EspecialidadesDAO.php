<?php

require_once "config/Conexion.php";
require_once "models/Especialidades.php";

class EspecialidadesDAO{
    private $conexion;

    public function __construct(){
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function listar(){
        try{
            $query = "SELECT * FROM Especialidades";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute();
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorId($idEspecialidad){
        try{
            $query = "SELECT * FROM Especialidades WHERE idEspecialidad = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idEspecialidad]);
            return $preparado->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function registrar(Especialidades $especialidad){
        try{
            $query = "INSERT INTO Especialidades (nombre, descripcion, estado)
                    VALUES (?, ?, ?)";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $especialidad->getNombre(),
                $especialidad->getDescripcion(),
                $especialidad->getEstado()
            ]);
            return ["success" => true, "message" => "Especialidad registrada correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function actualizar(Especialidades $especialidad){
        try{
            $query = "UPDATE Especialidades SET nombre = ?, descripcion = ?, estado = ?
                    WHERE idEspecialidad = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $especialidad->getNombre(),
                $especialidad->getDescripcion(),
                $especialidad->getEstado(),
                $especialidad->getIdEspecialidad()
            ]);
            return ["success" => true, "message" => "Especialidad actualizada correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function eliminar($idEspecialidad){
        try{
            $query = "DELETE FROM Especialidades WHERE idEspecialidad = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idEspecialidad]);
            return ["success" => true, "message" => "Especialidad eliminada correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
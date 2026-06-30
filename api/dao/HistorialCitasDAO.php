<?php

require_once "config/Conexion.php";
require_once "models/HistorialCitas.php";

class HistorialCitasDAO{
    private $conexion;

    public function __construct(){
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function listar(){
        try{
            $query = "SELECT * FROM HistorialCitas";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute();
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorId($idHistorial){
        try{
            $query = "SELECT * FROM HistorialCitas WHERE idHistorial = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idHistorial]);
            return $preparado->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function registrar(HistorialCitas $historial){
        try{
            $query = "INSERT INTO HistorialCitas (idCita, observaciones, diagnostico, tratamiento, fechaRegistro)
                    VALUES (?, ?, ?, ?, NOW())";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $historial->getIdCita(),
                $historial->getObservaciones(),
                $historial->getDiagnostico(),
                $historial->getTratamiento()
            ]);
            return ["success" => true, "message" => "Historial registrado correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function actualizar(HistorialCitas $historial){
        try{
            $query = "UPDATE HistorialCitas SET idCita = ?, observaciones = ?, diagnostico = ?, tratamiento = ?
                    WHERE idHistorial = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $historial->getIdCita(),
                $historial->getObservaciones(),
                $historial->getDiagnostico(),
                $historial->getTratamiento(),
                $historial->getIdHistorial()
            ]);
            return ["success" => true, "message" => "Historial actualizado correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function eliminar($idHistorial){
        try{
            $query = "DELETE FROM HistorialCitas WHERE idHistorial = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idHistorial]);
            return ["success" => true, "message" => "Historial eliminado correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
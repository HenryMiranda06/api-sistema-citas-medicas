<?php

require_once "config/Conexion.php";
require_once "models/Citas.php";

class CitasDAO{
    private $conexion;

    public function __construct(){
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function listar(){
        try{
            $query = "SELECT * FROM citas";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute();
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorId($idCita){
        try{
            $query = "SELECT * FROM citas WHERE idCita = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idCita]);
            return $preparado->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function registrar(Citas $cita){
        try{
            $query = "INSERT INTO citas (idPaciente, idDoctor, idEspecialidad, idAgenda, fecha, hora, motivo, estado, fechaRegistro)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $cita->getIdPaciente(),
                $cita->getIdDoctor(),
                $cita->getIdEspecialidad(),
                $cita->getIdAgenda(),
                $cita->getFecha(),
                $cita->getHora(),
                $cita->getMotivo(),
                $cita->getEstado()
            ]);
            return ["success" => true, "message" => "Cita registrada correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function actualizar(Citas $cita){
        try{
            $query = "UPDATE citas SET idPaciente = ?, idDoctor = ?, idEspecialidad = ?, idAgenda = ?, fecha = ?, hora = ?, motivo = ?, estado = ?
                    WHERE idCita = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $cita->getIdPaciente(),
                $cita->getIdDoctor(),
                $cita->getIdEspecialidad(),
                $cita->getIdAgenda(),
                $cita->getFecha(),
                $cita->getHora(),
                $cita->getMotivo(),
                $cita->getEstado(),
                $cita->getIdCita()
            ]);
            return ["success" => true, "message" => "Cita actualizada correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function eliminar($idCita){
        try{
            $query = "DELETE FROM citas WHERE idCita = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idCita]);
            return ["success" => true, "message" => "Cita eliminada correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
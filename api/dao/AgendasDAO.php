<?php

require_once "config/Conexion.php";
require_once "models/Agendas.php";

class AgendasDAO{
    private $conexion;

    public function __construct(){
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function listar(){
        try{
            $query = "SELECT * FROM agenda";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute();
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorId($idAgenda){
        try{
            $query = "SELECT * FROM agenda WHERE idAgenda = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idAgenda]);
            return $preparado->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorDoctor($idUsuario){
        try{
            $query = "SELECT a.* FROM agenda a INNER JOIN doctores d ON a.idDoctor = d.idDoctor INNER JOIN usuarios u ON d.idPersona = u.idPersona
                WHERE u.idUsuario = ?;";

            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idUsuario]);   
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarDoctor($idUsuario){
        try{
            $query = "SELECT d.idDoctor FROM doctores d INNER JOIN usuarios u ON d.idPersona = u.idPersona WHERE u.idUsuario = ?;";

            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idUsuario]);

            $resultado = $preparado->fetch(PDO::FETCH_ASSOC);

            return $resultado ? $resultado['idDoctor'] : null;

        }catch(PDOException $e ){
            return null;
        }
    }

    public function registrar(Agendas $agenda){
        try{
            $query = "INSERT INTO agenda (idDoctor, fecha, horaInicio, horaFin, estado)
                    VALUES (?, ?, ?, ?, ?)";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $agenda->getIdDoctor(),
                $agenda->getFecha(),
                $agenda->getHoraInicio(),
                $agenda->getHoraFin(),
                $agenda->getEstado()
            ]);
            return ["success" => true, "message" => "Agenda registrada correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function actualizar(Agendas $agenda){
        try{
            $query = "UPDATE agenda SET idDoctor = ?, fecha = ?, horaInicio = ?, horaFin = ?, estado = ?
                    WHERE idAgenda = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $agenda->getIdDoctor(),
                $agenda->getFecha(),
                $agenda->getHoraInicio(),
                $agenda->getHoraFin(),
                $agenda->getEstado(),
                $agenda->getIdAgenda()
            ]);
            return ["success" => true, "message" => "Agenda actualizada correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function eliminar($idAgenda){
        try{
            $query = "DELETE FROM agenda WHERE idAgenda = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idAgenda]);
            return ["success" => true, "message" => "Agenda eliminada correctamente."];
        }catch(PDOException $e){
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
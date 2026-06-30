<?php

require_once "views/respuesta.php";
require_once "dao/HistorialCitasDAO.php";

class HistorialCitasController{
    private $dao;

    public function __construct(){
        $this->dao = new HistorialCitasDAO();
    }

    public function listar(){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar()
        ]);
    }

    public function buscarPorId($idHistorial){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->buscarPorId($idHistorial)
        ]);
    }

    public function registrar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $historial = new HistorialCitas();
        $historial -> setIdCita($json["idCita"]);
        $historial -> setObservaciones($json["observaciones"] ?? null);
        $historial -> setDiagnostico($json["diagnostico"] ?? null);
        $historial -> setTratamiento($json["tratamiento"] ?? null);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->registrar($historial)
        ]);
    }

    public function actualizar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $historial = new HistorialCitas();
        $historial -> setIdHistorial($json["idHistorial"]);
        $historial -> setIdCita($json["idCita"]);
        $historial -> setObservaciones($json["observaciones"] ?? null);
        $historial -> setDiagnostico($json["diagnostico"] ?? null);
        $historial -> setTratamiento($json["tratamiento"] ?? null);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->actualizar($historial)
        ]);
    }

    public function eliminar($idHistorial){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminar($idHistorial)
        ]);
    }
}
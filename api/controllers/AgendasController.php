<?php

require_once "views/respuesta.php";
require_once "dao/AgendasDAO.php";

class AgendasController{
    private $dao;

    public function __construct(){
        $this->dao = new AgendasDAO();
    }

    public function listar(){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar()
        ]);
    }

    public function buscarPorId($idAgenda){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->buscarPorId($idAgenda)
        ]);
    }

    public function registrar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $agenda = new Agendas();
        $agenda -> setIdDoctor($json["idDoctor"]);
        $agenda -> setFecha($json["fecha"]);
        $agenda -> setHoraInicio($json["horaInicio"]);
        $agenda -> setHoraFin($json["horaFin"]);
        $agenda -> setEstado($json["estado"] ?? "Disponible");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->registrar($agenda)
        ]);
    }

    public function actualizar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $agenda = new Agendas();
        $agenda -> setIdAgenda($json["idAgenda"]);
        $agenda -> setIdDoctor($json["idDoctor"]);
        $agenda -> setFecha($json["fecha"]);
        $agenda -> setHoraInicio($json["horaInicio"]);
        $agenda -> setHoraFin($json["horaFin"]);
        $agenda -> setEstado($json["estado"] ?? "Disponible");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->actualizar($agenda)
        ]);
    }

    public function eliminar($idAgenda){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminar($idAgenda)
        ]);
    }
}
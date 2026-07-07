<?php

require_once "views/respuesta.php";
require_once "dao/CitasDAO.php";

class CitasController{
    private $dao;

    public function __construct(){
        $this->dao = new CitasDAO();
    }

    public function listar(){
        $idUsuario = $_GET['idUsuario'] ?? null;
        $rol = $_GET['rol'] ?? null;

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar($idUsuario, $rol)
        ]);
    }

    public function buscarPorId($idCita){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->buscarPorId($idCita)
        ]);
    }

    public function registrar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $cita = new Citas();
        $cita -> setIdPaciente($json["idPaciente"]);
        $cita -> setIdDoctor($json["idDoctor"]);
        $cita -> setIdEspecialidad($json["idEspecialidad"]);
        $cita -> setIdAgenda($json["idAgenda"] ?? null);
        $cita -> setFecha($json["fecha"]);
        $cita -> setHora($json["hora"]);
        $cita -> setMotivo($json["motivo"] ?? null);
        $cita -> setEstado($json["estado"] ?? "Pendiente");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->registrar($cita)
        ]);
    }

    public function actualizar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $cita = new Citas();
        $cita -> setIdCita($json["idCita"]);
        $cita -> setIdPaciente($json["idPaciente"]);
        $cita -> setIdDoctor($json["idDoctor"]);
        $cita -> setIdEspecialidad($json["idEspecialidad"]);
        $cita -> setIdAgenda($json["idAgenda"] ?? null);
        $cita -> setFecha($json["fecha"]);
        $cita -> setHora($json["hora"]);
        $cita -> setMotivo($json["motivo"] ?? null);
        $cita -> setEstado($json["estado"] ?? "Pendiente");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->actualizar($cita)
        ]);
    }

    public function eliminar($idCita){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminar($idCita)
        ]);
    }
}
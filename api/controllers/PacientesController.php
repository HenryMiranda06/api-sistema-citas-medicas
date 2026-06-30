<?php

require_once "views/respuesta.php";
require_once "dao/PacientesDAO.php";

class PacientesController{
    private $dao;

    public function __construct(){
        $this->dao = new PacientesDAO();
    }

    public function listar(){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar()
        ]);
    }

    public function buscarPorId($idPaciente){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->buscarPorId($idPaciente)
        ]);
    }

    public function registrar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $paciente = new Pacientes();
        $paciente -> setIdUsuario($json["idUsuario"] ?? null);
        $paciente -> setCedula($json["cedula"]);
        $paciente -> setNombre($json["nombre"]);
        $paciente -> setTelefono($json["telefono"] ?? null);
        $paciente -> setFechaNacimiento($json["fechaNacimiento"] ?? null);
        $paciente -> setDireccion($json["direccion"] ?? null);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->registrar($paciente)
        ]);
    }

    public function actualizar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $paciente = new Pacientes();
        $paciente -> setIdPaciente($json["idPaciente"]);
        $paciente -> setIdUsuario($json["idUsuario"] ?? null);
        $paciente -> setCedula($json["cedula"]);
        $paciente -> setNombre($json["nombre"]);
        $paciente -> setTelefono($json["telefono"] ?? null);
        $paciente -> setFechaNacimiento($json["fechaNacimiento"] ?? null);
        $paciente -> setDireccion($json["direccion"] ?? null);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->actualizar($paciente)
        ]);
    }

    public function eliminar($idPaciente){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminar($idPaciente)
        ]);
    }
}
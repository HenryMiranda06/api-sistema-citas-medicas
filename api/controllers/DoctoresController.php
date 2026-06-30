<?php

require_once "views/respuesta.php";
require_once "dao/DoctoresDAO.php";

class DoctoresController{
    private $dao;

    public function __construct(){
        $this->dao = new DoctoresDAO();
    }

    public function listar(){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar()
        ]);
    }

    public function buscarPorId($idDoctor){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->buscarPorId($idDoctor)
        ]);
    }

    public function registrar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $doctor = new Doctores();
        $doctor -> setIdUsuario($json["idUsuario"] ?? null);
        $doctor -> setIdEspecialidad($json["idEspecialidad"]);
        $doctor -> setCedula($json["cedula"]);
        $doctor -> setNombre($json["nombre"]);
        $doctor -> setTelefono($json["telefono"] ?? null);
        $doctor -> setCorreo($json["correo"] ?? null);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->registrar($doctor)
        ]);
    }

    public function actualizar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $doctor = new Doctores();
        $doctor -> setIdDoctor($json["idDoctor"]);
        $doctor -> setIdUsuario($json["idUsuario"] ?? null);
        $doctor -> setIdEspecialidad($json["idEspecialidad"]);
        $doctor -> setCedula($json["cedula"]);
        $doctor -> setNombre($json["nombre"]);
        $doctor -> setTelefono($json["telefono"] ?? null);
        $doctor -> setCorreo($json["correo"] ?? null);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->actualizar($doctor)
        ]);
    }

    public function eliminar($idDoctor){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminar($idDoctor)
        ]);
    }
}
<?php

require_once "views/respuesta.php";
require_once "dao/EspecialidadesDAO.php";

class EspecialidadesController{
    private $dao;

    public function __construct(){
        $this->dao = new EspecialidadesDAO();
    }

    public function listar(){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar()
        ]);
    }

    public function buscarPorId($idEspecialidad){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->buscarPorId($idEspecialidad)
        ]);
    }

    public function registrar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $especialidad = new Especialidades();
        $especialidad -> setNombre($json["nombre"]);
        $especialidad -> setDescripcion($json["descripcion"] ?? null);
        $especialidad -> setEstado($json["estado"] ?? "Activo");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->registrar($especialidad)
        ]);
    }

    public function actualizar(){
        $json = json_decode(file_get_contents("php://input"), true);

        $especialidad = new Especialidades();
        $especialidad -> setIdEspecialidad($json["idEspecialidad"]);
        $especialidad -> setNombre($json["nombre"]);
        $especialidad -> setDescripcion($json["descripcion"] ?? null);
        $especialidad -> setEstado($json["estado"] ?? "Activo");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->actualizar($especialidad)
        ]);
    }

    public function eliminar($idEspecialidad){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminar($idEspecialidad)
        ]);
    }
}
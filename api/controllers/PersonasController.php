<?php

require_once "views/respuesta.php";
require_once "dao/PersonasDAO.php";

class PersonasController
{
    private $dao;

    public function __construct()
    {
        $this->dao = new PersonasDAO();
    }

    public function listar()
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar()
        ]);
    }

    public function buscarPorId($idPersona)
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->buscarPorId($idPersona)
        ]);
    }

    public function registrar()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        $persona = new Personas();
        $persona->setCedula($json["cedula"]);
        $persona->setNombres($json["nombres"]);
        $persona->setApellidos($json["apellidos"]);
        $persona->setCorreo($json["correo"]);
        $persona->setTelefono($json["telefono"] ?? null);
        $persona->setFechaNacimiento($json["fechaNacimiento"] ?? null);
        $persona->setDireccion($json["direccion"] ?? null);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->registrar($persona)
        ]);
    }

    public function actualizar()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        $persona = new Personas();
        $persona->setIdPersona($json["idPersona"]);
        $persona->setCedula($json["cedula"]);
        $persona->setNombres($json["nombres"]);
        $persona->setApellidos($json["apellidos"]);
        $persona->setCorreo($json["correo"]);
        $persona->setTelefono($json["telefono"] ?? null);
        $persona->setFechaNacimiento($json["fechaNacimiento"] ?? null);
        $persona->setDireccion($json["direccion"] ?? null);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->actualizar($persona)
        ]);
    }

    public function eliminar($idPersona)
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminar($idPersona)
        ]);
    }
}

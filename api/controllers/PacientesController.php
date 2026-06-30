<?php

require_once "views/respuesta.php";
require_once "dao/PacientesDAO.php";

class PacientesController
{
    private $dao;

    public function __construct()
    {
        $this->dao = new PacientesDAO();
    }

    public function listar()
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar()
        ]);
    }

    public function buscarPorId($idPaciente)
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->buscarPorId($idPaciente)
        ]);
    }

    public function registrar()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        $paciente = new Pacientes();
        $paciente->setIdPersona($json["idPersona"]);
        $paciente->setTipoSangre($json["tipoSangre"] ?? null);
        $paciente->setAlergias($json["alergias"] ?? null);
        $paciente->setEnfermedadesCronicas($json["enfermedadesCronicas"] ?? null);
        $paciente->setAntecedentes($json["antecedentes"] ?? null);
        $paciente->setEstado($json["estado"] ?? "Activo");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->registrar($paciente)
        ]);
    }

    public function actualizar()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        $paciente = new Pacientes();
        $paciente->setIdPaciente($json["idPaciente"]);
        $paciente->setIdPersona($json["idPersona"]);
        $paciente->setTipoSangre($json["tipoSangre"] ?? null);
        $paciente->setAlergias($json["alergias"] ?? null);
        $paciente->setEnfermedadesCronicas($json["enfermedadesCronicas"] ?? null);
        $paciente->setAntecedentes($json["antecedentes"] ?? null);
        $paciente->setEstado($json["estado"] ?? "Activo");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->actualizar($paciente)
        ]);
    }

    public function eliminar($idPaciente)
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminar($idPaciente)
        ]);
    }
}

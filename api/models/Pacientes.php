<?php

class Pacientes
{
    private $idPaciente;
    private $idPersona;
    private $tipoSangre;
    private $alergias;
    private $enfermedadesCronicas;
    private $antecedentes;
    private $estado;
    private $fechaRegistro;

    public function getIdPaciente()
    {
        return $this->idPaciente;
    }
    public function getIdPersona()
    {
        return $this->idPersona;
    }
    public function getTipoSangre()
    {
        return $this->tipoSangre;
    }
    public function getAlergias()
    {
        return $this->alergias;
    }
    public function getEnfermedadesCronicas()
    {
        return $this->enfermedadesCronicas;
    }
    public function getAntecedentes()
    {
        return $this->antecedentes;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function setIdPaciente($idPaciente)
    {
        $this->idPaciente = $idPaciente;
    }
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }
    public function setTipoSangre($tipoSangre)
    {
        $this->tipoSangre = $tipoSangre;
    }
    public function setAlergias($alergias)
    {
        $this->alergias = $alergias;
    }
    public function setEnfermedadesCronicas($enfermedadesCronicas)
    {
        $this->enfermedadesCronicas = $enfermedadesCronicas;
    }
    public function setAntecedentes($antecedentes)
    {
        $this->antecedentes = $antecedentes;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }
}

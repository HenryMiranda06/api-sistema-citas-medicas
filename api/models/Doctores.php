<?php

class Doctores
{
    private $idDoctor;
    private $idPersona;
    private $idEspecialidad;
    private $numeroLicencia;
    private $estado;
    private $fechaRegistro;

    public function getIdDoctor()
    {
        return $this->idDoctor;
    }
    public function getIdPersona()
    {
        return $this->idPersona;
    }
    public function getIdEspecialidad()
    {
        return $this->idEspecialidad;
    }
    public function getNumeroLicencia()
    {
        return $this->numeroLicencia;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function setIdDoctor($idDoctor)
    {
        $this->idDoctor = $idDoctor;
    }
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }
    public function setIdEspecialidad($idEspecialidad)
    {
        $this->idEspecialidad = $idEspecialidad;
    }
    public function setNumeroLicencia($numeroLicencia)
    {
        $this->numeroLicencia = $numeroLicencia;
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

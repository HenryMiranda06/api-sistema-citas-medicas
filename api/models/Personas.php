<?php

class Personas
{
    private $idPersona;
    private $cedula;
    private $nombres;
    private $apellidos;
    private $correo;
    private $telefono;
    private $fechaNacimiento;
    private $direccion;
    private $fechaRegistro;

    public function getIdPersona()
    {
        return $this->idPersona;
    }
    public function getCedula()
    {
        return $this->cedula;
    }
    public function getNombres()
    {
        return $this->nombres;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getCorreo()
    {
        return $this->correo;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }
}

<?php

class Pacientes{
    private $idPaciente;
    private $idUsuario;
    private $cedula;
    private $nombre;
    private $telefono;
    private $fechaNacimiento;
    private $direccion;

    public function getIdPaciente(){ return $this->idPaciente; }
    public function getIdUsuario(){ return $this->idUsuario; }
    public function getCedula(){ return $this->cedula; }
    public function getNombre(){ return $this->nombre; }
    public function getTelefono(){ return $this->telefono; }
    public function getFechaNacimiento(){ return $this->fechaNacimiento; }
    public function getDireccion(){ return $this->direccion; }

    public function setIdPaciente($idPaciente){ $this->idPaciente = $idPaciente; }
    public function setIdUsuario($idUsuario){ $this->idUsuario = $idUsuario; }
    public function setCedula($cedula){ $this->cedula = $cedula; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setTelefono($telefono){ $this->telefono = $telefono; }
    public function setFechaNacimiento($fechaNacimiento){ $this->fechaNacimiento = $fechaNacimiento; }
    public function setDireccion($direccion){ $this->direccion = $direccion; }
}
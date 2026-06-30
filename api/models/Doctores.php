<?php

class Doctores{
    private $idDoctor;
    private $idUsuario;
    private $idEspecialidad;
    private $cedula;
    private $nombre;
    private $telefono;
    private $correo;

    public function getIdDoctor(){ return $this->idDoctor; }
    public function getIdUsuario(){ return $this->idUsuario; }
    public function getIdEspecialidad(){ return $this->idEspecialidad; }
    public function getCedula(){ return $this->cedula; }
    public function getNombre(){ return $this->nombre; }
    public function getTelefono(){ return $this->telefono; }
    public function getCorreo(){ return $this->correo; }

    public function setIdDoctor($idDoctor){ $this->idDoctor = $idDoctor; }
    public function setIdUsuario($idUsuario){ $this->idUsuario = $idUsuario; }
    public function setIdEspecialidad($idEspecialidad){ $this->idEspecialidad = $idEspecialidad; }
    public function setCedula($cedula){ $this->cedula = $cedula; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setTelefono($telefono){ $this->telefono = $telefono; }
    public function setCorreo($correo){ $this->correo = $correo; }
}
<?php

class Usuarios{
    private $idUsuario;
    private $nombre;
    private $correo;
    private $clave;
    private $rol;
    private $estado;
    private $fechaRegistro;

    public function getIdUsuario() { return $this->idUsuario; }
    public function getNombre() { return $this->nombre; }
    public function getCorreo() { return $this->correo; }
    public function getClave() { return $this->clave; }
    public function getRol() { return $this->rol; }
    public function getEstado() { return $this->estado; }
    public function getFechaRegistro() { return $this->fechaRegistro; }

    public function setIdUsuario($idUsuario) { $this->idUsuario = $idUsuario; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setClave($clave) { $this->clave = $clave; }
    public function setRol($rol) { $this->rol = $rol; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setFechaRegistro($fechaRegistro) { $this->fechaRegistro = $fechaRegistro; }
}
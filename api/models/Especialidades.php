<?php

class Especialidades{
    private $idEspecialidad;
    private $nombre;
    private $descripcion;
    private $estado;

    public function getIdEspecialidad(){ return $this->idEspecialidad; }
    public function getNombre(){ return $this->nombre; }
    public function getDescripcion(){ return $this->descripcion; }
    public function getEstado(){ return $this->estado; }

    public function setIdEspecialidad($idEspecialidad){ $this->idEspecialidad = $idEspecialidad; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
    public function setEstado($estado){ $this->estado = $estado; }
}
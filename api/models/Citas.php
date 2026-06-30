<?php

class Citas{
    private $idCita;
    private $idPaciente;
    private $idDoctor;
    private $idEspecialidad;
    private $idAgenda;
    private $fecha;
    private $hora;
    private $motivo;
    private $estado;
    private $fechaRegistro;

    public function getIdCita(){ return $this->idCita; }
    public function getIdPaciente(){ return $this->idPaciente; }
    public function getIdDoctor(){ return $this->idDoctor; }
    public function getIdEspecialidad(){ return $this->idEspecialidad; }
    public function getIdAgenda(){ return $this->idAgenda; }
    public function getFecha(){ return $this->fecha; }
    public function getHora(){ return $this->hora; }
    public function getMotivo(){ return $this->motivo; }
    public function getEstado(){ return $this->estado; }
    public function getFechaRegistro(){ return $this->fechaRegistro; }

    public function setIdCita($idCita){ $this->idCita = $idCita; }
    public function setIdPaciente($idPaciente){ $this->idPaciente = $idPaciente; }
    public function setIdDoctor($idDoctor){ $this->idDoctor = $idDoctor; }
    public function setIdEspecialidad($idEspecialidad){ $this->idEspecialidad = $idEspecialidad; }
    public function setIdAgenda($idAgenda){ $this->idAgenda = $idAgenda; }
    public function setFecha($fecha){ $this->fecha = $fecha; }
    public function setHora($hora){ $this->hora = $hora; }
    public function setMotivo($motivo){ $this->motivo = $motivo; }
    public function setEstado($estado){ $this->estado = $estado; }
    public function setFechaRegistro($fechaRegistro){ $this->fechaRegistro = $fechaRegistro; }
}
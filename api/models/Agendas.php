<?php

class Agendas{
    private $idAgenda;
    private $idDoctor;
    private $fecha;
    private $horaInicio;
    private $horaFin;
    private $estado;

    public function getIdAgenda(){ return $this->idAgenda; }
    public function getIdDoctor(){ return $this->idDoctor; }
    public function getFecha(){ return $this->fecha; }
    public function getHoraInicio(){ return $this->horaInicio; }
    public function getHoraFin(){ return $this->horaFin; }
    public function getEstado(){ return $this->estado; }

    public function setIdAgenda($idAgenda){ $this->idAgenda = $idAgenda; }
    public function setIdDoctor($idDoctor){ $this->idDoctor = $idDoctor; }
    public function setFecha($fecha){ $this->fecha = $fecha; }
    public function setHoraInicio($horaInicio){ $this->horaInicio = $horaInicio; }
    public function setHoraFin($horaFin){ $this->horaFin = $horaFin; }
    public function setEstado($estado){ $this->estado = $estado; }
}
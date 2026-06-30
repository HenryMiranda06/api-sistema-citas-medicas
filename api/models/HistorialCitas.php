<?php

class HistorialCitas{
    private $idHistorial;
    private $idCita;
    private $observaciones;
    private $diagnostico;
    private $tratamiento;
    private $fechaRegistro;

    public function getIdHistorial(){ return $this->idHistorial; }
    public function getIdCita(){ return $this->idCita; }
    public function getObservaciones(){ return $this->observaciones; }
    public function getDiagnostico(){ return $this->diagnostico; }
    public function getTratamiento(){ return $this->tratamiento; }
    public function getFechaRegistro(){ return $this->fechaRegistro; }

    public function setIdHistorial($idHistorial){ $this->idHistorial = $idHistorial; }
    public function setIdCita($idCita){ $this->idCita = $idCita; }
    public function setObservaciones($observaciones){ $this->observaciones = $observaciones; }
    public function setDiagnostico($diagnostico){ $this->diagnostico = $diagnostico; }
    public function setTratamiento($tratamiento){ $this->tratamiento = $tratamiento; }
    public function setFechaRegistro($fechaRegistro){ $this->fechaRegistro = $fechaRegistro; }
}
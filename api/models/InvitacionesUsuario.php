<?php

class InvitacionesUsuario
{
    private $idInvitacion;
    private $idPersona;
    private $token;
    private $rol;
    private $estado;
    private $fechaExpiracion;
    private $fechaUso;
    private $fechaRegistro;

    public function getIdInvitacion()
    {
        return $this->idInvitacion;
    }
    public function getIdPersona()
    {
        return $this->idPersona;
    }
    public function getToken()
    {
        return $this->token;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }
    public function getFechaUso()
    {
        return $this->fechaUso;
    }
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function setIdInvitacion($idInvitacion)
    {
        $this->idInvitacion = $idInvitacion;
    }
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }
    public function setToken($token)
    {
        $this->token = $token;
    }
    public function setRol($rol)
    {
        $this->rol = $rol;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;
    }
    public function setFechaUso($fechaUso)
    {
        $this->fechaUso = $fechaUso;
    }
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }
}

<?php

require_once "views/respuesta.php";
require_once "dao/InvitacionesUsuarioDAO.php";

class InvitacionesUsuarioController
{
    private $dao;

    public function __construct()
    {
        $this->dao = new InvitacionesUsuarioDAO();
    }

    public function crearInvitacion()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        $invitacion = new InvitacionesUsuario();
        $invitacion->setIdPersona($json["idPersona"]);
        $invitacion->setToken(bin2hex(random_bytes(32)));
        $invitacion->setRol($json["rol"]);
        $invitacion->setFechaExpiracion($json["fechaExpiracion"]);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->crearInvitacion($invitacion)
        ]);
    }

    public function validarToken()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->validarToken($json["token"])
        ]);
    }
}

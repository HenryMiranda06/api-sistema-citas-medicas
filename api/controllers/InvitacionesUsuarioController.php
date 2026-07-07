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

    public function obtenerInvitaciones(){
        $invitaciones = $this->dao->obtenerInvitaciones();

        convertirJSON([
            "code" => 200,
            "message" => $invitaciones
        ]);
    }

    public function crearInvitacion()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        $invitacion = new InvitacionesUsuario();

        $token = $this->crearToken();
        $hashToken = $this->hashearToken($token);

        $invitacion->setIdPersona($json["idPersona"]);
        $invitacion->setToken($hashToken);
        $invitacion->setRol($json["rol"]);
        $invitacion->setEstado("Pendiente");

        $resultado = $this->dao->crearInvitacion($invitacion);

        if($resultado["success"]){
            $resultado["token"] = $token;
        }

        convertirJSON([
            "code" => 200,
            "message" => $resultado
        ]);
    }

    public function validarToken($token){
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->validarToken($token)
        ]);
    }

    public function hashearToken($token){
        $hash = password_hash($token, PASSWORD_BCRYPT);
        return $hash;
    }

    public function crearToken()
    {
        $token = bin2hex(random_bytes(32));
        return $token;
    }

    public function eliminarInvitacion($idInvitacion){
        if (!$idInvitacion) {
            convertirJSON([
                "code" => 200,
                "message" => [
                    "success" => false,
                    "message" => "No se recibió el id de la invitación."
                ]
            ]);
            return;
        }

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminarInvitacion($idInvitacion)
        ]);
    }
}

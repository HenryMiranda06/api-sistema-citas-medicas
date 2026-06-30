<?php

require_once "views/respuesta.php";
require_once "dao/UsuariosDAO.php";
require_once "dao/InvitacionesUsuarioDAO.php";

class UsuariosController
{
    private $dao;
    private $invitacionesDAO;

    public function __construct()
    {
        $this->dao = new UsuariosDAO();
        $this->invitacionesDAO = new InvitacionesUsuarioDAO();
    }

    public function listar()
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar()
        ]);
    }

    public function buscarPorId($idUsuario)
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->buscarPorId($idUsuario)
        ]);
    }

    public function login()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        $usuario = new Usuarios();
        $usuario->setCorreo($json["correo"]);
        $usuario->setClave($json["clave"]);

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->login($usuario)
        ]);
    }

    public function crearCuentaConInvitacion()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        $validacion = $this->invitacionesDAO->validarToken($json["token"]);

        if (!$validacion["success"]) {
            convertirJSON([
                "code" => 400,
                "message" => $validacion
            ]);
            return;
        }

        $invitacion = $validacion["message"];

        $usuario = new Usuarios();
        $usuario->setIdPersona($invitacion["idPersona"]);
        $usuario->setCorreo($invitacion["correo"]);
        $usuario->setClave(password_hash($json["clave"], PASSWORD_BCRYPT));
        $usuario->setRol($invitacion["rol"]);
        $usuario->setEstado("Activo");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->crearDesdeInvitacion($usuario, $invitacion["idInvitacion"])
        ]);
    }
}

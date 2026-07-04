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

    public function crearCuenta()
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

        $idPersona = $validacion["idPersona"];
        $rol = $validacion["rol"];

        $usuario = new Usuarios();

        $usuario->setIdPersona($idPersona);
        $usuario->setCorreo($json["correo"]);
        $usuario->setClave(password_hash($json["clave"], PASSWORD_BCRYPT));
        $usuario->setRol($rol);
        $usuario->setEstado("Activo");

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->crearCuenta($usuario, $validacion["idInvitacion"])
        ]);
    }
}

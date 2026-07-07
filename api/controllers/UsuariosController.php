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
        session_start();

        $json = json_decode(file_get_contents("php://input"), true);

        $usuario = new Usuarios();
        $usuario->setCorreo($json["correo"]);
        $usuario->setClave($json["clave"]);

        try {
            $resultado = $this->dao->login($usuario);

            if ($resultado === null) {
                convertirJSON(["code" => 401, "success" => false, "message" => "Correo o clave incorrectos."]);
                return;
            }

            if ($resultado === "inactivo") {
                convertirJSON(["code" => 403, "success" => false, "message" => "La cuenta se encuentra inactiva."]);
                return;
            }

            $_SESSION['idUsuario'] = $resultado['idUsuario'];
            $_SESSION['rol'] = $resultado['rol'];

            convertirJSON([
                "code" => 200,
                "success" => true,
                "usuario" => [
                    "id" => $resultado["idUsuario"],
                    "correo" => $resultado["correo"],
                    "rol" => $resultado["rol"]
                ]
            ]);

        } catch (PDOException $e) {
            convertirJSON(["code" => 500, "success" => false, "message" => "Error en login: " . $e->getMessage()]);
        }
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

    public function listaUsuarios()
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->listar()
        ]);
    }

    public function desactivarUsuario($idUsuario){
        if (!$idUsuario) {
            convertirJSON([
                "code" => 200,
                "message" => [
                    "success" => false,
                    "message" => "No se recibió el id del usuario."
                ]
            ]);
            return;
        }

        convertirJSON([
            "code" => 200,
            "message" => $this->dao->desactivarUsuario($idUsuario)
        ]);
    }
}

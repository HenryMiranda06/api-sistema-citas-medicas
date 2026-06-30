<?php

require_once "views/respuesta.php";
require_once "dao/UsuariosDAO.php";

class UsuariosController
{
    private $dao;

    public function __construct()
    {
        $this->dao = new UsuariosDAO();
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

        if (!isset($json["correo"]) || !isset($json["clave"])) {
            convertirJSON([
                "code" => 400,
                "message" => [
                    "success" => false,
                    "message" => "Correo y clave son obligatorios."
                ]
            ]);
            return;
        }

        $usuario = new Usuarios();
        $usuario->setCorreo($json["correo"]);
        $usuario->setClave($json["clave"]);

        $resultado = $this->dao->login($usuario);

        convertirJSON([
            "code" => 200,
            "message" => $resultado
        ]);
    }

    public function registrarUsuario()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        if (!isset($json["nombre"]) || !isset($json["correo"]) || !isset($json["clave"])) {
            convertirJSON([
                "code" => 400,
                "message" => [
                    "success" => false,
                    "message" => "Nombre, correo y clave son obligatorios."
                ]
            ]);
            return;
        }

        $usuario = new Usuarios();
        $usuario->setNombre($json["nombre"]);
        $usuario->setCorreo($json["correo"]);
        $usuario->setClave($this->hashearClave($json["clave"]));
        $usuario->setRol("Paciente");
        $usuario->setEstado("Activo");

        $resultado = $this->dao->registrarUsuario($usuario);

        convertirJSON([
            "code" => 200,
            "message" => $resultado
        ]);
    }

    public function actualizarRol()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        if (!isset($json["idUsuario"]) || !isset($json["rol"])) {
            convertirJSON([
                "code" => 400,
                "message" => [
                    "success" => false,
                    "message" => "Id de usuario y rol son obligatorios."
                ]
            ]);
            return;
        }

        if (!$this->validarRol($json["rol"])) {
            convertirJSON([
                "code" => 400,
                "message" => [
                    "success" => false,
                    "message" => "Rol no permitido. Use Admin, Doctor o Paciente."
                ]
            ]);
            return;
        }

        //$resultado = $this->dao->actualizarRol($json["idUsuario"], $json["rol"]);

        /*convertirJSON([
            "code" => 200,
            "message" => $resultado
        ]);*/
    }

    public function validarRol($rol)
    {
        $rolesPermitidos = ["Admin", "Doctor", "Paciente"];
        return in_array($rol, $rolesPermitidos);
    }

    public function hashearClave($clave)
    {
        return password_hash($clave, PASSWORD_BCRYPT);
    }

    public function eliminar($idUsuario)
    {
        convertirJSON([
            "code" => 200,
            "message" => $this->dao->eliminar($idUsuario)
        ]);
    }
}

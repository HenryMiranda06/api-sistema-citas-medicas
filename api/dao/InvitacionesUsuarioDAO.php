<?php

require_once "config/Conexion.php";
require_once "models/InvitacionesUsuario.php";

class InvitacionesUsuarioDAO
{
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function crearInvitacion(InvitacionesUsuario $invitacion)
    {
        try {
            $query = "INSERT INTO invitaciones_usuario (idPersona, token, rol, estado, fechaExpiracion)
                    VALUES (?, ?, ?, 'Pendiente', ?)";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $invitacion->getIdPersona(),
                $invitacion->getToken(),
                $invitacion->getRol(),
                $invitacion->getFechaExpiracion()
            ]);

            return [
                "success" => true,
                "message" => "Invitación creada correctamente.",
                "token" => $invitacion->getToken()
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function buscarPorToken($token)
    {
        try {
            $query = "SELECT i.*, p.correo, p.nombres, p.apellidos
                    FROM invitaciones_usuario i
                    INNER JOIN personas p ON i.idPersona = p.idPersona
                    WHERE i.token = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$token]);

            return $preparado->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function validarToken($token)
    {
        $invitacion = $this->buscarPorToken($token);

        if (!$invitacion) {
            return [
                "success" => false,
                "message" => "Token inválido."
            ];
        }

        if (isset($invitacion["error"])) {
            return [
                "success" => false,
                "message" => $invitacion["error"]
            ];
        }

        if ($invitacion["estado"] !== "Pendiente") {
            return [
                "success" => false,
                "message" => "La invitación no está disponible."
            ];
        }

        if (strtotime($invitacion["fechaExpiracion"]) < time()) {
            return [
                "success" => false,
                "message" => "La invitación ha expirado."
            ];
        }

        return [
            "success" => true,
            "message" => $invitacion
        ];
    }
}

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

    public function obtenerInvitaciones()
    {
        $query = "SELECT * FROM invitaciones_usuario";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearInvitacion(InvitacionesUsuario $invitacion)
    {
        try {
            $queryVerificar = "SELECT idInvitacion FROM invitaciones_usuario WHERE idPersona = ? AND estado = 'Pendiente'";
            $preparadoVerificar = $this->conexion->prepare($queryVerificar);
            $preparadoVerificar->execute([$invitacion->getIdPersona()]);

            if ($preparadoVerificar->rowCount() > 0) {
                return [
                    "success" => false,
                    "message" => "Ya existe una invitación pendiente para esta persona. Debe usarse o cancelarse antes de generar otra."
                ];
            }

            $query = "INSERT INTO invitaciones_usuario (idPersona, token, rol, estado) VALUES (?, ?, ?, ?)";
            $preparado = $this->conexion->prepare($query);

            $preparado->execute([
                $invitacion->getIdPersona(),
                $invitacion->getToken(),
                $invitacion->getRol(),
                $invitacion->getEstado(),
            ]);

            return [
                "success" => true,
                "message" => "Invitación creada correctamente."
            ];

        } catch (PDOException $e) {
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function validarToken($token)
    {
        $query = "SELECT * FROM invitaciones_usuario WHERE estado = 'Pendiente'";

        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $invitaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($invitaciones as $invitacion) {
            if (password_verify($token, $invitacion["token"])) {
                return [
                    "success" => true,
                    "message" => "Token válido.",
                    "idPersona" => $invitacion["idPersona"],
                    "rol" => $invitacion["rol"],
                    "idInvitacion" => $invitacion["idInvitacion"]
                ];
            }
        }

        return [
            "success" => false,
            "message" => "Token inválido o expirado"
        ];
    }
}

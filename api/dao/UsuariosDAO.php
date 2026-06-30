<?php

require_once "config/Conexion.php";
require_once "models/Usuarios.php";

class UsuariosDAO
{
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function login(Usuarios $usuario)
    {
        try {
            $query = "SELECT u.*, p.nombres, p.apellidos
                    FROM usuarios u
                    INNER JOIN personas p ON u.idPersona = p.idPersona
                    WHERE u.correo = ?";

            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$usuario->getCorreo()]);
            $resultado = $preparado->fetch(PDO::FETCH_ASSOC);

            if (!$resultado) {
                return [
                    "success" => false,
                    "message" => "El correo indicado no existe."
                ];
            }

            if ($resultado["estado"] !== "Activo") {
                return [
                    "success" => false,
                    "message" => "La cuenta se encuentra inactiva."
                ];
            }

            if (!password_verify($usuario->getClave(), $resultado["clave"])) {
                return [
                    "success" => false,
                    "message" => "Correo o clave incorrectos."
                ];
            }

            return [
                "success" => true,
                "message" => "Login exitoso.",
                "usuario" => [
                    "idUsuario" => $resultado["idUsuario"],
                    "idPersona" => $resultado["idPersona"],
                    "nombres" => $resultado["nombres"],
                    "apellidos" => $resultado["apellidos"],
                    "correo" => $resultado["correo"],
                    "rol" => $resultado["rol"],
                    "estado" => $resultado["estado"]
                ]
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "message" => "Error en login: " . $e->getMessage()
            ];
        }
    }

    public function crearDesdeInvitacion(Usuarios $usuario, $idInvitacion)
    {
        try {
            $this->conexion->beginTransaction();

            $queryUsuarioExistente = "SELECT idUsuario FROM usuarios WHERE idPersona = ? OR correo = ?";
            $preparadoUsuarioExistente = $this->conexion->prepare($queryUsuarioExistente);
            $preparadoUsuarioExistente->execute([
                $usuario->getIdPersona(),
                $usuario->getCorreo()
            ]);

            if ($preparadoUsuarioExistente->fetch()) {
                $this->conexion->rollBack();

                return [
                    "success" => false,
                    "message" => "La persona ya tiene una cuenta creada."
                ];
            }

            $queryUsuario = "INSERT INTO usuarios (idPersona, correo, clave, rol, estado)
                    VALUES (?, ?, ?, ?, ?)";

            $preparadoUsuario = $this->conexion->prepare($queryUsuario);
            $preparadoUsuario->execute([
                $usuario->getIdPersona(),
                $usuario->getCorreo(),
                $usuario->getClave(),
                $usuario->getRol(),
                $usuario->getEstado()
            ]);

            $queryInvitacion = "UPDATE invitaciones_usuario
                    SET estado = 'Usado', fechaUso = NOW()
                    WHERE idInvitacion = ?";

            $preparadoInvitacion = $this->conexion->prepare($queryInvitacion);
            $preparadoInvitacion->execute([$idInvitacion]);

            $this->conexion->commit();

            return [
                "success" => true,
                "message" => "Cuenta creada correctamente."
            ];
        } catch (PDOException $e) {
            $this->conexion->rollBack();

            return [
                "success" => false,
                "message" => "Error al crear cuenta: " . $e->getMessage()
            ];
        }
    }
}

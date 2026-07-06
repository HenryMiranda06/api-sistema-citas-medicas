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
            $query = "SELECT idUsuario, correo, clave, estado, rol FROM usuarios WHERE correo = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$usuario->getCorreo()]);
            $resultado = $preparado->fetch(PDO::FETCH_ASSOC);

            if (!$resultado) {
                return null; 
            }

            if ($resultado["estado"] !== "Activo") {
                return "inactivo";
            }

            if (!password_verify($usuario->getClave(), $resultado["clave"])) {
                return null;
            }

            return $resultado; 

        } catch (PDOException $e) {
            throw $e; 
        }
    }

   public function crearCuenta(Usuarios $usuario, $idInvitacion)
    {
        try {
            $this->conexion->beginTransaction();

            $queryValidacion = "SELECT idUsuario FROM usuarios 
                    WHERE estado = 'Activo' 
                    AND (idPersona = ? OR correo = ?)";

            $stmt = $this->conexion->prepare($queryValidacion);
            $stmt->execute([
                $usuario->getIdPersona(),
                $usuario->getCorreo()
            ]);

            if ($stmt->fetch()) {
                $this->conexion->rollBack();

                return [
                    "success" => false,
                    "message" => "Ya existe una cuenta activa para esta persona o correo."
                ];
            }

            $queryUsuario = "INSERT INTO usuarios (idPersona, correo, clave, rol, estado) VALUES (?, ?, ?, ?, ?)";

            $preparadoUsuario = $this->conexion->prepare($queryUsuario);
            $preparadoUsuario->execute([
                $usuario->getIdPersona(),
                $usuario->getCorreo(),
                $usuario->getClave(),
                $usuario->getRol(),
                $usuario->getEstado()
            ]);

            $queryInvitacion = "UPDATE invitaciones_usuario SET estado = 'Usado' WHERE idInvitacion = ?";

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

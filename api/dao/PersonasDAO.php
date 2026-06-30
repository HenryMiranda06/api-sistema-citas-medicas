<?php

require_once "config/Conexion.php";
require_once "models/Personas.php";

class PersonasDAO
{
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function listar()
    {
        try {
            $query = "SELECT * FROM personas";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute();
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function buscarPorId($idPersona)
    {
        try {
            $query = "SELECT * FROM personas WHERE idPersona = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idPersona]);
            return $preparado->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function registrar(Personas $persona)
    {
        try {
            $query = "INSERT INTO personas (cedula, nombres, apellidos, correo, telefono, fechaNacimiento, direccion)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $persona->getCedula(),
                $persona->getNombres(),
                $persona->getApellidos(),
                $persona->getCorreo(),
                $persona->getTelefono(),
                $persona->getFechaNacimiento(),
                $persona->getDireccion()
            ]);

            return [
                "success" => true,
                "message" => "Persona registrada correctamente.",
                "idPersona" => $this->conexion->lastInsertId()
            ];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function actualizar(Personas $persona)
    {
        try {
            $query = "UPDATE personas SET cedula = ?, nombres = ?, apellidos = ?, correo = ?, telefono = ?, fechaNacimiento = ?, direccion = ?
                    WHERE idPersona = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([
                $persona->getCedula(),
                $persona->getNombres(),
                $persona->getApellidos(),
                $persona->getCorreo(),
                $persona->getTelefono(),
                $persona->getFechaNacimiento(),
                $persona->getDireccion(),
                $persona->getIdPersona()
            ]);

            return ["success" => true, "message" => "Persona actualizada correctamente."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function eliminar($idPersona)
    {
        try {
            $query = "DELETE FROM personas WHERE idPersona = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$idPersona]);

            return ["success" => true, "message" => "Persona eliminada correctamente."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}

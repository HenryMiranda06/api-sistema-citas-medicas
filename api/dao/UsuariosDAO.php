<?php

require_once "config/Conexion.php";
require_once "models/Usuarios.php";

class UsuariosDAO{
    private $conexion;

    public function __construct(){
        $db = new Conexion();
        $this->conexion = $db->Conectar();
    }

    public function login(Usuarios $usuario){
        try{
            $query = "SELECT * FROM usuarios WHERE correo = ?";
            $preparado = $this->conexion->prepare($query);
            $preparado->execute([$usuario->getCorreo()]);
            $resultado = $preparado->fetch(PDO::FETCH_ASSOC);

            if(!$resultado){
                return ["error" => "El correo indicado no existe, por favor cree un usuario."];
            }

            if($resultado["estado"] !== "Activo"){
                return ["error" => "La cuenta se encuentra inactiva."];
            }

            if(password_verify($usuario->getClave(), $resultado["clave"])){
                return [
                    "mensaje" => "Login exitoso.",
                    "usuario" => [
                        "idUsuario" => $resultado["idUsuario"],
                        "nombre" => $resultado["nombre"],
                        "correo" => $resultado["correo"],
                        "rol" => $resultado["rol"],
                        "estado" => $resultado["estado"]
                    ]
                ];
            }

            return ["error" => "Correo o clave incorrectos."];
        }catch(PDOException $e){
            return ["error" => "Error en login: " . $e->getMessage()];
        }
    }

    public function registrarUsuario(Usuarios $usuario){
        try{
            $queryVerificar = "SELECT idUsuario FROM usuarios WHERE correo = ?";
            $preparadoVerificar = $this->conexion->prepare($queryVerificar);
            $preparadoVerificar->execute([$usuario->getCorreo()]);

            if($preparadoVerificar->fetch()){
                return [
                    "success" => false,
                    "message" => "Ya existe un usuario registrado con ese correo."
                ];
            }

            $query = "INSERT INTO usuarios (nombre, correo, clave, rol, estado, fechaRegistro)
                    VALUES (?, ?, ?, ?, ?, NOW())";

            $preparado = $this->conexion->prepare($query);

            $preparado->execute([
                $usuario->getNombre(),
                $usuario->getCorreo(),
                $usuario->getClave(),
                $usuario->getRol(),
                $usuario->getEstado()
            ]);

            return [
                "success" => true,
                "message" => "Usuario registrado correctamente."
            ];
        }catch(PDOException $e){
            return [
                "success" => false,
                "message" => "Error al registrar usuario: " . $e->getMessage()
            ];
        }
    }
}
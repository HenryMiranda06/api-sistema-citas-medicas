<?php

require_once __DIR__ . '/../controllers/UsuariosController.php';

$controlador = new UsuariosController();
$uri = $_SERVER['REQUEST_URI'];
$metodo = $_SERVER['REQUEST_METHOD'];
$id = $_GET["id"] ?? null;

switch ($metodo) {
    case 'GET':
        $id ? $controlador -> buscarPorId($id) : $controlador -> listar();
        break;

    case 'POST':
        if(str_contains($uri, 'login')){
            $controlador -> login();
        }elseif(str_contains($uri, 'usuario')){
            $controlador -> registrarUsuario();
        }else{
            http_response_code(404);
            echo json_encode(["error" => "Ruta no encontrada"]);
        }
        break;

    case 'PUT':
        if(str_contains($uri, 'rol')){
            $controlador -> actualizarRol();
        }else{
            http_response_code(404);
            echo json_encode(["error" => "Ruta no encontrada"]);
        }
        break;

    case 'DELETE':
        if(!$id){
            http_response_code(400);
            echo json_encode(["error" => "Debe enviar el id"]);
            break;
        }

        $controlador -> eliminar($id);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
}

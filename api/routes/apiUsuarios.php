<?php

require_once __DIR__ . '/../controllers/UsuariosController.php';

$controlador = new UsuariosController();
$metodo = $_SERVER['REQUEST_METHOD'];
$idUsuario = $_GET['id'] ?? null;

switch ($metodo) {
    case 'GET':
        $controlador-> listaUsuarios();
        break;

    case 'POST':
        if (isset($_GET["create"])) {
            $controlador->crearCuenta();
        }else {
            $controlador->login();
        }
        break;

    case 'DELETE':
        $controlador-> desactivarUsuario($idUsuario);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
}
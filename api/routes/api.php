<?php

require_once __DIR__ . '/../controllers/UsuariosController.php';

$controlador = new UsuariosController();
$uri = $_SERVER['REQUEST_URI'];
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'POST':
        if(str_contains($uri, 'login')) $controlador -> login();
        if(str_contains($uri, 'usuario')) $controlador -> registrarUsuario();
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
}
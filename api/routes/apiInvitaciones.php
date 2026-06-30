<?php

require_once __DIR__ . '/../controllers/InvitacionesUsuarioController.php';

$controlador = new InvitacionesUsuarioController();
$uri = $_SERVER['REQUEST_URI'];
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'POST':
        if (str_contains($uri, 'validar')) {
            $controlador->validarToken();
        } else {
            $controlador->crearInvitacion();
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
}

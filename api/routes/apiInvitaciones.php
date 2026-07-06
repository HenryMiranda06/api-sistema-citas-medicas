<?php

require_once __DIR__ . '/../controllers/InvitacionesUsuarioController.php';

$controlador = new InvitacionesUsuarioController();
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'POST':
        if (isset($_GET["token"])) {
            $controlador->validarToken($_GET["token"]);
        } else {
            $controlador->crearInvitacion();
        }
        break;
    case 'GET':
        $controlador->obtenerInvitaciones();
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
}
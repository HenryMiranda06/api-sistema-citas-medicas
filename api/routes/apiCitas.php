<?php

require_once __DIR__ . '/../controllers/CitasController.php';

$controlador = new CitasController();
$metodo = $_SERVER['REQUEST_METHOD'];
$id = $_GET["id"] ?? null;

switch ($metodo) {
    case 'GET':
        $id ? $controlador -> buscarPorId($id) : $controlador -> listar();
        break;

    case 'POST':
        $controlador -> registrar();
        break;

    case 'PUT':
        $controlador -> actualizar();
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
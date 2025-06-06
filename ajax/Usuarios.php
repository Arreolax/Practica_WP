<?php
require_once "../modelos/Usuarios_Model.php";
 
header('Content-Type: applicaction/json');
$usuario = new UsuariosModel();         //Se llama la funcion del modelo
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode($usuario -> getAll());
    break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['sucess' => $usuario -> create($data)]);
    break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['sucess' => $usuario -> update($data)]);
    break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(['sucess' => $usuario -> delete($data['id'])]);
    break;

    default:
        http_response_code(405);    // Maper el codigo si no se escuentra el metodo
        echo json_encode(['error' => 'Metodo Invalido']);
}

<?php
require_once '../modelos/Ordenes_Model.php';
 
header('Content-Type: application/json');
$orden = new OrdenesModel();         //Se llama la funcion del modelo
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode($orden -> getAll());
    break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['sucess' => $orden -> create($data)]);
    break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['sucess' => $orden -> update($data)]);
    break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(['sucess' => $orden -> delete($data)]);
    break;

    default:
        http_response_code(405);    // Maper el codigo si no se escuentra el metodo
        echo json_encode(['error' => 'Metodo Invalido']);
}

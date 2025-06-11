<?php
require_once "../modelos/DetalleOrden_Model.php";

header("Content-Type: application/json");
$detalleOrden = new DetalleOrdenModel();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode($detalleOrden->getAllDetalleOrden());
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $detalleOrden->createDetalleOrden($data)]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $detalleOrden->updateDetalleOrden($data)]);
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(['success' => $detalleOrden->deleteDetalleOrden($data['id'])]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
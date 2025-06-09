<?php
require_once '../modelos/Productos_Model.php';
 
header('Content-Type: application/json');
$producto = new ProductsModel();         //Se llama la funcion del modelo
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode($producto -> getAllProductos());
    break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['sucess' => $producto -> createProducto($data)]);
    break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['sucess' => $producto -> updateProducto($data)]);
    break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(['sucess' => $producto -> deleteProducto($data)]);
    break;

    default:
        http_response_code(405);    // Maper el codigo si no se escuentra el metodo
        echo json_encode(['error' => 'Metodo Invalido']);
}

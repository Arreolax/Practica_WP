<?php
require_once "conexion.php";    // Llamar un archivo
header('Content-Type: application/json');

//aqui ponemos el log de acciones
$logFile = 'login.log';
//creamos funcion por si no hay donde guardar
if (!file_exists($logFile)) {

    if (!is_writable(__DIR__)) {
        echo json_encode(
            [
                "succes" => false,
                "message" => "No has dado permisos dile a Jeather"
            ]
        );
    }
}

//funcion que escribe
function guardarLog($usuario, $estado){
    global $logFile;
    $fecha = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'N/A';
    $navegador = $_SERVER['HTTP_USER_AGENT'] ?? 'N/A';
    $entrada = "[$fecha] IP: $ip - Usuario: $usuario - Resultado: $estado - Navegador: $navegador\n";
    file_put_contents($logFile, $entrada, FILE_APPEND);
}

//leer datos de JSON
$input = json_decode(file_get_contents('php://input'), true);

if($_SERVER['REQUEST_METHOD'] === 'POST' && $input){
                        // que no cambie nada 
    $nombre = $conexion -> real_escape_string($input['nombre'] ?? ''); 
    $pass = $conexion -> real_escape_string($input['pass'] ?? '');

    //aqui vamoh a consultar el pass 'contrasena'
    $sql = " SELECT * FROM usuarios WHERE nombre = '$nombre' AND contrasena='$pass'";
    $result = $conexion -> query($sql);

    if($result && $result -> num_rows === 1){
        guardarLog($nombre, "Exito");
        echo json_encode([
            "success" => true,
            "message" => "Bienvenido, $nombre"
        ]);
    }else{
        guardarLog($nombre, "Fallo");
        echo json_encode([
            "success" => false,
            "message" => "Usuario Incorrecto"
        ]);
    }
}else{
    echo json_encode([
        "success" => false,
        "message" => "Datos Incompletos"
    ]);
}
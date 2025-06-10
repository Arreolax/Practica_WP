<?php
require_once "../config/conexion.php";

class UsuariosModel {
    private $conn;

    public function __construct()
    {
        $this -> conn = new mysqli("localhost", "root", "", "practica1");
    }

    public function getAll() {
        $result = $this -> conn -> query("SELECT * FROM usuarios");
        return $result -> fetch_all(MYSQLI_ASSOC);
    }
    
    public function create($data) {
        $stmt = $this -> conn -> prepare("INSERT INTO usuarios (nombre, correo, contrasena, telefono, direccion) VALUES (?, ?, ?, ?, ?)");
        $stmt -> bind_param("sssss", $data['nombre'], $data['correo'], $data['contrasena'], $data['telefono'], $data['direccion']);
        //Parametrizar los datos s->string
        return $stmt -> execute();
    }

    public function update($data) {
        $stmt = $this -> conn -> prepare("UPDATE usuarios SET nombre=?, correo=?, contrasena=?, telefono=?, direccion=? WHERE id_usuario=?");
        $stmt -> bind_param("sssssi", $data['nombre'], $data['correo'], $data['contrasena'], $data['telefono'], $data['direccion'], $data['id_usuario']);
        //Parametrizar los datos s->string i->entero
        return $stmt -> execute();
    }

    public function delete($id) {
        $stmt = $this -> conn -> prepare("DELETE FROM usuarios WHERE id_usuario=?");
        $stmt -> bind_param("i", $id);
        //Parametrizar los datos i->entero
        return $stmt -> execute();
    }
}
?>
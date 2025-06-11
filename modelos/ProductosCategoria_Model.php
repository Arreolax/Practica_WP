<?php
require_once "../config/conexion.php";

class ProductoCategoriaModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "practica1");

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    // Obtener todos los registros de producto_categoria
    public function getAll() {
        $result = $this->conn->query("SELECT * FROM producto_categoria");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Crear un nuevo vínculo producto-categoría
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO producto_categoria (id_producto, id_categoria) VALUES (?, ?)");
        $stmt->bind_param("ii", $data['id_producto'], $data['id_categoria']);
        return $stmt->execute();
    }

    // Actualizar un vínculo producto-categoría (cambiar ambos IDs)
    public function update($data) {
        $stmt = $this->conn->prepare("UPDATE producto_categoria SET id_producto = ?, id_categoria = ? WHERE id_producto = ? AND id_categoria = ?");
        $stmt->bind_param("iiii", $data['nuevo_id_producto'], $data['nuevo_id_categoria'], $data['id_producto'], $data['id_categoria']);
        return $stmt->execute();
    }

    // Eliminar un vínculo producto-categoría
    public function delete($id_producto, $id_categoria) {
        $stmt = $this->conn->prepare("DELETE FROM producto_categoria WHERE id_producto = ? AND id_categoria = ?");
        $stmt->bind_param("ii", $id_producto, $id_categoria);
        return $stmt->execute();
    }
}
?>

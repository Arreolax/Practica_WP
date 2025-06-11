<?php
require_once "../config/conexion.php";

class DetalleOrdenModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "practica1");

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function getAllDetalleOrden()
    {
        $result = $this->conn->query("SELECT * FROM detalle_orden");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createDetalleOrden($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO detalle_orden (id_orden, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $data['id_orden'], $data['id_producto'], $data['cantidad'], $data['precio_unitario']);
        return $stmt->execute();
    }

    public function updateDetalleOrden($data)
    {
        $stmt = $this->conn->prepare("UPDATE detalle_orden SET cantidad=?, precio_unitario=? WHERE id_detalle=?");
        $stmt->bind_param("idi", $data['cantidad'], $data['precio_unitario'], $data['id_detalle']);
        return $stmt->execute();
    }

    public function deleteDetalleOrden($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM detalle_orden WHERE id_detalle = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>
<?php
require_once "../config/conexion.php";

class ProductsModel
{
    private $conn;

    public function getAllCarrito()
    {
        $result = $this->conn->query("SELECT * FROM carrito");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createCarrito($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $data['id_usuario'], $data['id_producto'], $data['cantidad']);
        return $stmt->execute();
    }

    public function updateCarrito($data)
    {
        $stmt = $this->conn->prepare("UPDATE carrito SET cantidad=? WHERE id_carrito=?");
        $stmt->bind_param("ii", $data['cantidad'], $data['id_carrito']);
        return $stmt->execute();
    }

    public function deleteCarrito($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM carrito WHERE id_carrito = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}
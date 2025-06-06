<?php
require_once "conexion.php";

class ProductsModel
{
    private $conn;

    public function getAllProductoCategoria()
    {
        $result = $this->conn->query("SELECT * FROM producto_categoria");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createProductoCategoria($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO producto_categoria (id_producto, id_categoria) VALUES (?, ?)");
        $stmt->bind_param("ii", $data['id_producto'], $data['id_categoria']);
        return $stmt->execute();
    }

    public function deleteProductoCategoria($id_producto, $id_categoria)
    {
        $stmt = $this->conn->prepare("DELETE FROM producto_categoria WHERE id_producto = ? AND id_categoria = ?");
        $stmt->bind_param("ii", $id_producto, $id_categoria);
        return $stmt->execute();
    }


    
}
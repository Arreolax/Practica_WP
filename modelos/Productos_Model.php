<?php
require_once "../config/conexion.php";

class ProductsModel 
{
    private $conn;

    public function __construct()
    {
        $this -> conn = new mysqli("localhost", "root", "", "shop");
    }
 
    public function getAllProductos()
    {
        $result = $this->conn->query("SELECT * FROM productos");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createProducto($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO productos (nombre_producto, descripcion, precio, stock, id_usuario, id_publico, descuento, id_categoria, publicidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiiiiii", $data['nombre_producto'], $data['descripcion'], $data['precio'], $data['stock'], $data['id_usuario'], $data['id_publico'], $data['descuento'], $data['id_categoria'], $data['publicidad']);
        return $stmt->execute();
    }

    public function updateProducto($data)
    {
        $stmt = $this->conn->prepare("UPDATE productos SET nombre_producto=?, descripcion=?, precio=?, stock=?, id_usuario=?, id_publico=?, descuento=?, id_categoria=?, publicidad=? WHERE id_producto=?");
        $stmt->bind_param("ssdiiiiiii", $data['nombre_producto'], $data['descripcion'], $data['precio'], $data['stock'], $data['id_usuario'], $data['id_publico'], $data['descuento'], $data['id_categoria'], $data['publicidad'], $data['id_producto']);
        return $stmt->execute();
    }

    public function deleteProducto($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM productos WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

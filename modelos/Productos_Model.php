<?php
require_once "conexion.php";

class ProductsModel 
{
    private $conn;

    public function getAllProductos()
    {
        $result = $this->conn->query("SELECT * FROM productos");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createProducto($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO productos (nombre_producto, descripcion, precio, stock, id_usuario, publico, publicidad, fecha_publicacion, id_publico, descuento, id_categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiisssiii", $data['nombre_producto'], $data['descripcion'], $data['precio'], $data['stock'], $data['id_usuario'], $data['publico'], $data['publicidad'], $data['fecha_publicacion'], $data['id_publico'], $data['descuento'], $data['id_categoria']);
        return $stmt->execute();
    }

    public function updateProducto($data)
    {
        $stmt = $this->conn->prepare("UPDATE productos SET nombre_producto=?, descripcion=?, precio=?, stock=?, id_usuario=?, publico=?, publicidad=?, fecha_publicacion=?, id_publico=?, descuento=?, id_categoria=? WHERE id_producto=?");
        $stmt->bind_param("ssdiisssiiii", $data['nombre_producto'], $data['descripcion'], $data['precio'], $data['stock'], $data['id_usuario'], $data['publico'], $data['publicidad'], $data['fecha_publicacion'], $data['id_publico'], $data['descuento'], $data['id_categoria'], $data['id_producto']);
        return $stmt->execute();
    }

    public function deleteProducto($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM productos WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

<?php
require_once "../config/conexion.php";

class CarritoModel
{
    private $conn;

    public function __construct()
    {
        $this -> conn = new mysqli("localhost", "root", "", "shop");
    }

    public function getAll()
    {
        $result = $this->conn->query("SELECT * FROM carrito");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $data['id_usuario'], $data['id_producto'], $data['cantidad']);
        return $stmt->execute();
    }

    public function update($data)
    {
        $stmt = $this->conn->prepare("UPDATE carrito SET id_usuario=?, id_producto=?, cantidad=? WHERE id_carrito=?");
        $stmt->bind_param("iiii", $data['id_usuario'], $data['id_producto'], $data['cantidad'], $data['id_carrito']);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM carrito WHERE id_carrito = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}
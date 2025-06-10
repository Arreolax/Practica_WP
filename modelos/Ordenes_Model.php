<?php
require_once "../config/conexion.php";

class OrdenesModel
{
    private $conn;

    public function __construct()
    {
        $this -> conn = new mysqli("localhost", "root", "", "shop");
    }

    public function getAll()
    {
        $result = $this->conn->query("SELECT * FROM ordenes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO ordenes (id_usuario, total, estado) VALUES (?, ?, ?)");
        $stmt->bind_param("ids", $data['id_usuario'], $data['total'], $data['estado']);
        return $stmt->execute();
    }

    public function update($data)
    {
        $stmt = $this->conn->prepare("UPDATE ordenes SET total=?, estado=? WHERE id_orden=?");
        $stmt->bind_param("dsi", $data['total'], $data['estado'], $data['id_orden']);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM ordenes WHERE id_orden = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    
}
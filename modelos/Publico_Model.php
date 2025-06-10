<?php
require_once "../config/conexion.php";

class PublicoModel {
    private $conn;

    public function __construct()
    {
        $this -> conn = new mysqli("localhost", "root", "", "shop");
    }

    public function getAll() {
        $result = $this -> conn -> query("SELECT * FROM publico");
        return $result -> fetch_all(MYSQLI_ASSOC);
    }
    
    public function create($data) {
        $stmt = $this -> conn -> prepare("INSERT INTO publico (nombre_publico) VALUES (?)");
        $stmt -> bind_param("s", $data['nombre_publico']);
        //Parametrizar los datos s->string
        return $stmt -> execute();
    }

    public function update($data) {
        $stmt = $this -> conn -> prepare("UPDATE publico SET nombre_publico=? WHERE id_publico=?");
        $stmt -> bind_param("si", $data['nombre_publico'], $data['id_publico']);
        //Parametrizar los datos s->string i->entero
        return $stmt -> execute();
    }

    public function delete($id) {
        $stmt = $this -> conn -> prepare("DELETE FROM publico WHERE id_publico=?");
        $stmt -> bind_param("i", $id);
        //Parametrizar los datos i->entero
        return $stmt -> execute();
    }
}
?>
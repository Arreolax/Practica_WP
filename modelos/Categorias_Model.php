<?php
require_once "conexion.php";

class CategoriasModel {
    private $conn;

    public function getAll() {
        $result = $this -> conn -> query("SELECT * FROM categorias");
        return $result -> fetch_all(MYSQLI_ASSOC);
    }
    
    public function create($data) {
        $stmt = $this -> conn -> prepare("INSERT INTO categorias (nombre_categoria) VALUES (?)");
        $stmt -> bind_param("s", $data['nombre_categoria']);
        //Parametrizar los datos s->string
        return $stmt -> execute();
    }

    public function update($data) {
        $stmt = $this -> conn -> prepare("UPDATE categorias (nombre_categoria) WHERE id_categoria=?");
        $stmt -> bind_param("si", $data['nombre_categoria'], $data['id_categoria']);
        //Parametrizar los datos s->string i->entero
        return $stmt -> execute();
    }

    public function delete($id) {
        $stmt = $this -> conn -> prepare("DELETE FROM categorias WHERE id_categoria=?");
        $stmt -> bind_param("i", $id);
        //Parametrizar los datos i->entero b-
        return $stmt -> execute();

    }
}
?>
<?php

class InventarioDAO {

    private $conexao;

    public function __construct()
    {
        include_once 'MySQL.php';

        $this->conexao = new MySQL();
    }

    public function getById($cod_inventario) {

        $stmt = $this->conexao->prepare("SELECT * FROM inventarios WHERE cod_inventario = ?");
        $stmt->bindValue(1, $cod_inventario);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function getAllRows() {
        $stmt = $this->conexao->prepare("SELECT * FROM inventarios ORDER BY cod_inventario");
        $stmt->execute();

        $arr_inventarios = array();

        while ($inv = $stmt->fetchObject()) {
            $arr_inventarios[] = $inv;
        }

        return $arr_inventarios;
    }

    public function insert($dados_inventario) {
        $sql = "INSERT INTO inventarios (nome_inventario) VALUES (?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_inventario['nome_inventario']);
        $stmt->execute();
    }


    public function getAllRows2() {
        $stmt = $this->conexao->prepare("SELECT * FROM inventario");
    }


    public function update($dados_inventario) {

        $sql = "UPDATE inventarios SET nome_inventario = ? WHERE cod_inventario = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_inventario['nome_inventario']);
        $stmt->bindValue(2, $dados_inventario['cod_inventario']);

        $stmt->execute();
    }

    public function delete($cod_inventario){

        $sql = "DELETE FROM inventarios WHERE cod_inventario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cod_inventario);
        $stmt->execute();
    }
}
?>

<?php

class InventarioDAO {

    private $conexao;

    public function __construct()
    {
        include_once 'MySQL.php';

        $this->conexao = new Mysql();
    }

    public function insert($dados_inventario) {
        $sql = "INSERT INTO inventarios (nome_inventario) VALUES (?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_inventario['nome_inventario']);
        $stmt->execute();
    }

    public function getAllRows() {
        $stmt = $this->conexao->prepare("SELECT * FROM inventarios");
        $stmt->execute();
        
        $arr_inventarios = array();

        while ($row = $stmt->fetchObject()) {
            $arr_inventarios[] = $row;
        }

        return $arr_inventarios;
    }
}

?>

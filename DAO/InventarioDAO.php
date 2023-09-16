// A
<?php

class InventarioDAO {

    private $conexao;

    public function __construct()
    {
        include_once 'MySQL.php';

        $this->conexao = new Mysql();
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

        while ($inv = $stmt->fetchObject())
            $arr_inventarios[] = $inv;

        return $arr_inventarios;
    }

    public function insert($dados_inventario) {
        $sql = "INSERT INTO inventario (nome_inventario) VALUES (?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_inventario['nome_inventario']);
        $stmt->execute();
    }

    public function getAllRows() {
        $stmt = $this->conexao->prepare("SELECT * FROM inventario");
        $stmt->execute();
    }

    /**
     * Remove um inventário da tabela Inventários.
     */
    public function delete($cod_inventario){

        $sql = "DELETE FROM inventarios WHERE cod_inventario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cod_inventario);
        $stmt->execute();
    }
}
?>

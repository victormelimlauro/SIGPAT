<?php

class OperacaoInventarioDAO {

    private $conexao;

    public function __construct()
    {
        include_once 'MySQL.php';

        $this->conexao = new Mysql();
    }

    public function insert($dados_operacao_inventario) {
        $sql = "INSERT INTO operacoes_inventarios (numpat_item, cod_inventario, cod_local, cod_usuario) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_operacao_inventario['numpat_item']);
        $stmt->bindValue(2, $dados_operacao_inventario['cod_inventario']);  
        $stmt->bindValue(3, $dados_operacao_inventario['cod_local']);  
        $stmt->bindValue(4, $dados_operacao_inventario['cod_usuario']);  
    
        $stmt->execute();
        var_dump($stmt);
    }


}

?>

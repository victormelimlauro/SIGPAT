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

    public function getAllRows() {
        $stmt = $this->conexao->prepare("SELECT  cod_operacoes_inventarios, b.cod_local, b.nome_local, c.numpat_item, c.nome_item, d.cod_inventario, d.nome_inventario, e.cod_usuario, e.nome
        FROM operacoes_inventarios as A
        INNER JOIN locais as B on a.cod_local= b.cod_local
        INNER JOIN itens  as C on a.numpat_item = c.numpat_item
        INNER JOIN inventarios  as D on a.cod_inventario = d.cod_inventario
        INNER JOIN usuarios  as E on a.cod_usuario = e.cod_usuario");
        $stmt->execute();
        
        $arr_inventarios = array();

        while ($row = $stmt->fetchObject()) {
            $arr_inventarios[] = $row;
        }

        return $arr_inventarios;
    }

    public function itensNaoLocalizadosNoSetor($dados_relatorio) {
        $stmt = $this->conexao->prepare("SELECT a.cod_local, f.nome_local, /*c.cod_local,*/ a.cod_item, a.numpat_item, a.nome_item , c.cod_inventario /*, d.nome_inventario */
        FROM itens as A
        /*CROSS JOIN locais as B on a.cod_local= b.cod_local*/
        LEFT OUTER JOIN operacoes_inventarios  as C on a.numpat_item = c.numpat_item
        /* INNER JOIN inventarios  as D on c.cod_inventario = d.cod_inventario */
        INNER JOIN locais as F on a.cod_local= f.cod_local
        WHERE a.numpat_item NOT IN (
		SELECT oi.numpat_item
		FROM operacoes_inventarios oi
		WHERE oi.cod_inventario = ?
		) AND a.cod_local = ?");
        $stmt->bindValue(1, $dados_relatorio['cod_inventario']);
        $stmt->bindValue(1, $dados_relatorio['cod_local']);
        $stmt->execute();
        
        $arr_relatorio = array();

        while ($row = $stmt->fetchObject()) {
            $arr_relatorio[] = $row;
        }

        return $arr_relatorio;
    }

    public function itensLocalizadosNoSetor($dados_relatorio) {
        $stmt = $this->conexao->prepare("SELECT  cod_operacoes_inventarios, b.cod_local, b.nome_local, c.numpat_item, c.nome_item, d.cod_inventario, d.nome_inventario, e.cod_usuario, e.nome
        FROM operacoes_inventarios as A
        INNER JOIN locais as B on a.cod_local= b.cod_local
        INNER JOIN itens  as C on a.numpat_item = c.numpat_item
        INNER JOIN inventarios  as D on a.cod_inventario = d.cod_inventario
        INNER JOIN usuarios  as E on a.cod_usuario = e.cod_usuario
        WHERE a.cod_inventario = ? and  a.cod_local = ?");
        $stmt->bindValue(1, $dados_relatorio['cod_inventario']);
        $stmt->bindValue(1, $dados_relatorio['cod_local']);
        $stmt->execute();
        
        $arr_relatorio = array();

        while ($row = $stmt->fetchObject()) {
            $arr_relatorio[] = $row;
        }

        return $arr_relatorio;
    }


}

?>

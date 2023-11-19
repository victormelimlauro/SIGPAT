<?php

class RelatorioDAO {

    private $conexao;

    public function __construct()
    {
        include_once 'MySQL.php';

        $this->conexao = new Mysql();
    }

    public function getitensLocalCorreto($dados_relatorio) {
        $stmt = $this->conexao->prepare("SELECT  cod_operacoes_inventarios, a.cod_local, b.nome_local, c.cod_local, f.nome_local, c.numpat_item, c.nome_item, d.cod_inventario, d.nome_inventario
        FROM operacoes_inventarios as a
        INNER JOIN locais as b on a.cod_local= b.cod_local
        INNER JOIN itens  as c on a.numpat_item = c.numpat_item
        INNER JOIN inventarios  as d on a.cod_inventario = d.cod_inventario
        INNER JOIN usuarios  as e on a.cod_usuario = e.cod_usuario
        INNER JOIN locais as f on c.cod_local= f.cod_local
        WHERE a.cod_inventario = ? AND a.cod_local = C.cod_local");
        $stmt->bindValue(1, $dados_relatorio['cod_inventario']);
        $stmt->execute();
        
        $arr_relatorio = array();

        while ($row = $stmt->fetchObject()) {
            $arr_relatorio[] = $row;
        }

        return $arr_relatorio;
    }

    public function itensLocalDivergente($dados_relatorio) {
        $stmt = $this->conexao->prepare("SELECT  cod_operacoes_inventarios, a.cod_local AS cod_local_encontrado , b.nome_local AS nome_local_encontrado, c.cod_local AS cod_local_cadastrado, f.nome_local AS nome_local_cadastrado, c.numpat_item, c.nome_item, d.cod_inventario, d.nome_inventario
        FROM operacoes_inventarios as a
        INNER JOIN locais as b on a.cod_local= b.cod_local
        INNER JOIN itens  as c on a.numpat_item = c.numpat_item
        INNER JOIN inventarios  as d on a.cod_inventario = d.cod_inventario
        INNER JOIN usuarios  as e on a.cod_usuario = e.cod_usuario
        INNER JOIN locais as f on c.cod_local= f.cod_local
        WHERE a.cod_inventario = ? AND a.cod_local <> C.cod_local");
        $stmt->bindValue(1, $dados_relatorio['cod_inventario']);
        $stmt->execute();
        
        $arr_relatorio = array();

        while ($row = $stmt->fetchObject()) {
            $arr_relatorio[] = $row;
        }

        return $arr_relatorio;
    }

    public function itensNaoLocalizados($dados_relatorio) {
        $stmt = $this->conexao->prepare("SELECT DISTINCT  a.cod_local, f.nome_local, /*c.cod_local,*/ a.cod_item, a.numpat_item, a.nome_item , c.cod_inventario /*, d.nome_inventario */
        FROM itens as a
        /*CROSS JOIN locais as B on a.cod_local= b.cod_local*/
        LEFT OUTER JOIN operacoes_inventarios  as c on a.numpat_item = c.numpat_item
        /* INNER JOIN inventarios  as D on c.cod_inventario = d.cod_inventario */
        INNER JOIN locais as f on a.cod_local= f.cod_local
        WHERE a.numpat_item NOT IN (
		SELECT oi.numpat_item
		FROM operacoes_inventarios oi
		WHERE oi.cod_inventario = ?
		);");
        $stmt->bindValue(1, $dados_relatorio['cod_inventario']);
        $stmt->execute();
        
        $arr_relatorio = array();

        while ($row = $stmt->fetchObject()) {
            $arr_relatorio[] = $row;
        }

        return $arr_relatorio;
    }

    public function getAllRows() {
        $stmt = $this->conexao->prepare("SELECT  cod_operacoes_inventarios, b.cod_local, b.nome_local, c.numpat_item, c.nome_item, d.cod_inventario, d.nome_inventario, e.cod_usuario, e.nome
        FROM operacoes_inventarios as a
        INNER JOIN locais as b on a.cod_local= b.cod_local
        INNER JOIN itens  as c on a.numpat_item = c.numpat_item
        INNER JOIN inventarios  as d on a.cod_inventario = d.cod_inventario
        INNER JOIN usuarios  as e on a.cod_usuario <> e.cod_usuario");
        $stmt->execute();
        
        $arr_inventarios = array();

        while ($row = $stmt->fetchObject()) {
            $arr_inventarios[] = $row;
        }

        return $arr_inventarios;
    }


}

?>

<?php

class ItemDAO {

    private $conexao;

    /**
     * Cria um novo objeto para fazer o CRUD de Itens
     */

     public function __construct()
     {
        include_once 'MySQL.php';

        $this->conexao = new Mysql();
     }

     /**
      * Retorna um registro especifoc da tabela Itens
      */
    public function getById($cod_item) {

        $stmt = $this->conexao->prepare("SELECT * FROM itens WHERE cod_item = ?");
        $stmt->bindValue(1, $cod_item);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    /**
     * Retorna todos os registros da tabela Itens.
     */
    public function getAllRows() {

        $stmt = $this->conexao->prepare("SELECT * FROM itens");
        $stmt->execute();
        
        $arr_itens = array();

        while($c = $stmt->fetchObject())
            $arr_itens[] = $c;

        return $arr_itens;
    }

    /**
     * Método que insere um item na tabela Items
     */
    public function insert($dados_item) {

        $sql = "INSERT INTO itens
                            (numpat_item, cod_local, nome_item, preco_item)
                            VALUES
                            (?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_item['numpat_item']);
        $stmt->bindValue(2, $dados_item['cod_local']);
        $stmt->bindValue(3, $dados_item['nome_item']);
        $stmt->bindValue(4, $dados_item['preco_item']);
        $stmt->execute();
    }

    /**
     * Atualiza um registro na tabela Categoria.
     */
    public function update($dados_item) {

        $sql = "UPDATE itens
                SET numpat_item = ?, cod_local = ?, nome_item= ?, preco_item = ?
                WHERE cod_item = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_item['numpat_item']);
        $stmt->bindValue(2, $dados_item['cod_local']);
        $stmt->bindValue(3, $dados_item['nome_item']);
        $stmt->bindValue(4, $dados_item['preco_item']);
        $stmt->bindValue(5, $dados_item['cod_item']);
        $stmt->execute();
    }

    public function delete($cod_item){
       
        $sql = "DELETE FROM itens WHERE cod_item=? ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cod_item);
        $stmt->execute();

    }
}
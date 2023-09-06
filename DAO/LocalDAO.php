<?php

class LocalDAO {

    private $conexao;
    /**
    *Cria um novo objeto para CRUD dos locais
    */
    public function __construct()
    {
        include "MySQL.php";
        $this->conexao = new MySQL();
    }

    /**
     * Retorna um registro com base no cod
     */
    public function getById($cod_local) {
        $stmt = $this->conexao->prepare("SELECT * FROM locais WHERE cod_local=?");
        $stmt->bindValue(1, $cod_local);
        $stmt->execute();

        return $stmt->fetchObject();

    }
    public function getAllRows() {
        $stmt = $this->conexao->prepare("SELECT * FROM locais ORDER BY cod_local");
        $stmt->execute();

        $arr_locais = array();

        while ($c = $stmt->fetchObject())
          $arr_locais[] = $c;

         return $arr_locais;
    }
    public function insert($dados_local){
        $sql = "INSERT INTO locais (nome_local) values (?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_local['nome_local']);
      
        $stmt->execute();
        //var_dump($stmt);
    }

    /**
     * Atualiza um local no BD
     */

    public function update($dados_local){
        $sql = "UPDATE locais SET nome_local = ? WHERE cod_local=? ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $dados_local['nome_local']);
        $stmt->bindValue(2, $dados_local['cod_local']);
        $stmt->execute();
    }
     /**
     * Remove um local no BD
     */
    public function delete($cod_local){
        $sql = "DELETE FROM locais WHERE cod_local=? ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cod_local);
        $stmt->execute();
    }
}
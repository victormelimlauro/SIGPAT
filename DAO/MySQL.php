<?php


//DAO - Data Access Object
class Mysql extends PDO {
    private $host = "localhost";
    private $usuario="u903350443_sigpat";
    private $senha="Vv81@n+**";
    private $db="u903350443_sigpat";

    private $opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    public function __construct()
    {

        //data source name
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db;
      
        //PHP Data Object
        return parent::__construct($dsn, $this->usuario, $this->senha, $this->opcoes);

        //return $conexao;
    }
}

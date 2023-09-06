<?php 

session_start();

if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");
    
try {

    if(isset($_GET['salvar']))
    //Verifica se o SALVAR vindo da URL está setado para lançar alterações no BD
    {

        include "../../DAO/LocalDAO.php";

        $local_dao = new LocalDAO();

       // $nome_local = $_POST["nome_local"];


        $dados_local = array (
        'nome_local' => $_POST["nome_local"]
        );

       if(!empty($_POST['cod_local']))  {
        // Verifica se está setado via POST vindo do formulário o valor COD_LOCAL para realizar UPDADE ou INSERT 

            $dados_local['cod_local'] = $_POST["cod_local"];

            $local_dao ->update($dados_local);

            echo"Atualizado";
            var_dump($_POST);
            //header("Location: listar_locais.php");
       } else {
        
        $local_dao->insert($dados_local);
        var_dump($dados_local);
           echo"Inserido";

       }


    }

    if(isset($_GET['excluir']))
    {
        include "../../DAO/LocalDAO.php";

        $local_dao = new LocalDAO();

        $local_dao->delete($_GET["cod_local"]);
        // var_dump($_GET["cod_local"]);
        header("Location: listar_locais.php");
    }

    /**
     * A função abaixo retorna dados do BD com base no parametro ID passado via método GET na URL
     */

    if(isset($_GET['cod_local']))
    {
        include "../../DAO/LocalDAO.php";

        $local_dao = new LocalDAO();

        $dados_local = $local_dao->getById($_GET["cod_local"]);
       // var_dump($dados_local);
        
    }

} catch(Exception $e) {

    echo $e->getMessage();

}
?>
<html lang="pt-br">
    <head>     
        <title>CADASTRA LOCAL</title>
        <meta charset="utf8" />
    </head>
    <body>
        <div id="global">
            <?php include '../../includes/cabecalho.php' ?>
            <main>
                <form method="post" action="cadastrar_local.php?salvar=true">
                    <label> Código do local:
                        <input name="cod_local" value="<?= isset($dados_local) ? $dados_local->cod_local : NULL ?>" type="text" readonly/>
                    </label>
                    <label>Nome do local:
                        <input name="nome_local" value="<?= isset($dados_local) ? $dados_local->nome_local : "" ?> " type="text" />

                    </label>
                    <a href="cadastrar_local.php?excluir=true&cod_local=<?=  $dados_local->cod_local ?>">
                    Excluir
                    </a>
                    <button type="submit"> Salvar </button>
                </form>
            </main>
            <?php include '../../includes/rodape.php' ?>
        </div>

    </body>
</html>
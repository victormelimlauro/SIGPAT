<?php 

session_start();

if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");

try {

    /**
     * Obtendo os locais
     */

    include "../../DAO/LocalDAO.php";

    $local_dao = new LocalDAO();

    $lista_locais = $local_dao->getAllRows();

    $total_locais = count($lista_locais);


    if(isset($_GET['salvar']))
    //Verifica se o SALVAR vindo da URL está setado para lançar alterações no BD
    {

        include "../../DAO/ItemDAO.php";

        $item_dao = new ItemDAO();

       // $nome_local = $_POST["nome_local"];


        $dados_item = array (
        'numpat_item' => $_POST["numpat_item"],
        'cod_local' => $_POST["cod_local"],
        'nome_item' => $_POST["nome_item"],
        'preco_item' => $_POST["preco_item"],
        );

       if(!empty($_POST['cod_item']))  {
        // Verifica se está setado via POST vindo do formulário o valor COD_LOCAL para realizar UPDADE ou INSERT 

            $dados_item['cod_item'] = $_POST["cod_item"];

            $item_dao ->update($dados_item);

            echo"Atualizado";
            var_dump($_POST);
            //header("Location: listar_locais.php");
       } else {
        
        $item_dao->insert($dados_item);
        var_dump($dados_item);
           echo"Inserido";

       }

    }
       
    if(isset($_GET['excluir']))
    {
        include "../../DAO/ItemDAO.php";

        $item_dao = new ItemDAO();

        $item_dao->delete($_GET["cod_item"]);
        // var_dump($_GET["cod_local"]);
        header("Location: lista_itens.php");
    }

    /**
     * A função abaixo retorna dados do BD com base no parametro ID passado via método GET na URL
     */
    
    if(isset($_GET['cod_item']))
    {
        echo "GET BY ID Acionado";
        include "../../DAO/ItemDAO.php";

        $item_dao = new ItemDAO();

        $dados_item = $item_dao->getById($_GET["cod_item"]);
       // var_dump($dados_local);
        
    }


    

} catch(Exception $e) {

    echo $e->getMessage();

}
?>
<html>
    <head>
        <title> Cadastro de produtos </title>

        <style>
            label, input, select {display: block; padding: 5px}
        </style>

    </head>

    <body>
        <?php include '../../includes/cabecalho.php' ?>

        <main>
        <h1>Cadastro de itens</h1>
            <form method="post" action="cadastrar_item.php?salvar=true"> 
            <label> Código do item:
                        <input name="cod_item" value="<?= isset($dados_item) ? $dados_item->cod_item : NULL ?>" type="text" readonly/>
                    </label>
            <label> Número de patrimônio do Item:
                        <input name="numpat_item" type="number"  value="<?= isset($dados_item) ? $dados_item->numpat_item : NULL ?>" />
                    </label>
            <label>Nome do item:
                <input name="nome_item" type="text" value="<?= isset($dados_item) ? $dados_item->nome_item : NULL ?>"/>
            </label>

            <label>Preço:
                <input name="preco_item" type="number" value="<?= isset($dados_item) ? $dados_item->preco_item : NULL ?>"/>
            </label>

            <label> Local:
                <select name="cod_local">
                    <option>Selecione o local</option>

                    <?php for($i=0; $i<$total_locais; $i++): 

                        $selecionado = " ";

                        if(isset($dados_item->cod_local))
                        {
                            $selecionado = ($lista_locais[$i]->cod_local == $dados_item->cod_local) ? "selected" : "";
                        }

                        ?>
                    <option value="<?= $lista_locais[$i]->cod_local ?>" <?= $selecionado ?> >
                        <?= $lista_locais[$i]->nome_local ?> 
                    </option>
                    <?php endfor ?>

                </select>
            </label>
            <button type="submit"> Salvar </button>

            </form>
        </main>

        <?php include '../../includes/rodape.php' ?>
    </body>
</html>
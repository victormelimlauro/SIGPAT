<?php 

try {

    /**
     * Obtendo os locais
     */

    include "../../DAO/LocalDAO.php";

    $local_dao = new LocalDAO();

    $lista_locais = $local_dao->getAllRows();

    $total_locais = count($lista_locais);

    /**
     * Obtendo os inventários
     */
    include "../../DAO/InventarioDAO.php";

    $inventario_dao = new InventarioDAO();

    $lista_inventarios = $inventario_dao->getAllRows();

    $total_inventarios = count($lista_inventarios);


    if(isset($_GET['salvar']))
    //Verifica se o SALVAR vindo da URL está setado para lançar alterações no BD
    {

        include "../../DAO/OperacaoInventarioDAO.php";

        $OperacaoInventario_dao = new OperacaoInventarioDAO();

       // $nome_local = $_POST["nome_local"];


        $dados_operacao_inventario = array (
        'cod_inventario' => $_POST["cod_inventario"],
        'cod_local' => $_POST["cod_local"],
        'numpat_item' => $_POST["numpat_item"],
        'cod_usuario' => $_POST["cod_usuario"],
        );
        
        var_dump($dados_operacao_inventario);
        $OperacaoInventario_dao->insert($dados_operacao_inventario);
           echo"Inserido";

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
        <title> Cadastro de produtos - TESTE </title>

        <style>
            label, input, select {display: block; padding: 5px}
        </style>

    </head>

    <body>
        <?php include '../../includes/cabecalho.php' ?>

        <main>

            <form method="post" action="cadastrar_operacao.php?salvar=true"> 
            <label> Inventario:
                <select name="cod_inventario">
                    <option>Selecione o Inventario</option>

                    <?php for($i=0; $i<$total_inventarios; $i++): 

                        $selecionado = " ";

                        if(isset($dados_item->cod_inventario))
                        {
                            $selecionado = ($lista_inventarios[$i]->cod_inventario == $dados_item->cod_inventario) ? "selected" : "";
                        }

                        ?>
                    <option value="<?= $lista_inventarios[$i]->cod_inventario ?>" <?= $selecionado ?> >
                        <?= $lista_inventarios[$i]->nome_inventario ?> 
                    </option>
                    <?php endfor ?>

                </select>
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
            <label> Número de patrimônio do Item:
                        <input name="numpat_item" type="text"  value="<?= isset($dados_item) ? $dados_item->numpat_item : NULL ?>" />
            </label>
            <label> Usuário responsavél - Codigo
                        <input name="cod_usuario" type="text" readonly  value="<?= $dados_do_usuario->cod_usuario ?>" />
            </label>
            <label> Usuário responsavél - Nome / username
                        <input name="nome_usuario" type="text" readonly  value="<?= $dados_do_usuario->nome ?> / <?= $dados_do_usuario->username ?> " />
            </label>
            <button type="submit"> Salvar </button>

            </form>
        </main>

        <?php include '../../includes/rodape.php' ?>
    </body>
</html>
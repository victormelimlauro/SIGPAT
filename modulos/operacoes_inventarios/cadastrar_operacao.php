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

        include "../../DAO/ItemDAO.php";

        $item_dao = new ItemDAO();

       // $nome_local = $_POST["nome_local"];


        $dados_item = array (
        'numpat_item' => $_POST["numpat_item"],
        'cod_local' => $_POST["cod_local"],
        'nome_item' => $_POST["nome_item"],
        'preco_item' => $_POST["preco_item"],
        );
        
        $item_dao->insert($dados_item);
        var_dump($dados_item);
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

            <form method="post" action="cadastrar_item.php?salvar=true"> 
            <label> Local:
                <select name="cod_local">
                    <option>Selecione o local</option>

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

            <button type="submit"> Salvar </button>

            </form>
        </main>

        <?php include '../../includes/rodape.php' ?>
    </body>
</html>
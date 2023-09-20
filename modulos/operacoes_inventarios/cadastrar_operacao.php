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

    /**
     * Obtendo os inventários
     */
    include "../../DAO/InventarioDAO.php";

    $inventario_dao = new InventarioDAO();

    $lista_inventarios = $inventario_dao->getAllRows();

    $total_inventarios = count($lista_inventarios);

    if(isset($_GET['listar']))
    //Verifica se o SALVAR vindo da URL está setado para lançar alterações no BD
    {

        include "../../DAO/OperacaoInventarioDAO.php";

        $OperacaoInventario_dao = new OperacaoInventarioDAO();

        $dados_operacao_inventario = array (
        'cod_inventario' => $_POST["cod_inventario"],
        'cod_local' => $_POST["cod_local"],
        'numpat_item' => $_POST["numpat_item"],
        'cod_usuario' => $_POST["cod_usuario"],
        );

        $lista_itensNaoLocalizadosNoSetor = $OperacaoInventario_dao->itensNaoLocalizadosNoSetor($dados_operacao_inventario);
        $total_itensNaoLocalizadosNoSetor = count($lista_itensNaoLocalizadosNoSetor);
        $lista_itensLocalizadosNoSetor =$OperacaoInventario_dao->itensLocalizadosNoSetor($dados_operacao_inventario);
        $total_itensLocalizadosNoSetor = count($lista_itensLocalizadosNoSetor);

        $count = $OperacaoInventario_dao->countOperacoesItemInventario($dados_operacao_inventario);
       // var_dump($count);
       
       }    

    //var_dump($dados_local);
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
        
        $contaOperacoesItemInventario = $OperacaoInventario_dao->countOperacoesItemInventario($dados_operacao_inventario);
        //var_dump($contaOperacoesItemInventario);

        if ($contaOperacoesItemInventario<=0) {
            $OperacaoInventario_dao->insert($dados_operacao_inventario);
            echo"Inserido";
            
        }
        else {
            echo("Já existe uma operação realizada para este ativo neste inventário");
        }
        $lista_itensNaoLocalizadosNoSetor = $OperacaoInventario_dao->itensNaoLocalizadosNoSetor($dados_operacao_inventario);
        $total_itensNaoLocalizadosNoSetor = count($lista_itensNaoLocalizadosNoSetor);
        $lista_itensLocalizadosNoSetor =$OperacaoInventario_dao->itensLocalizadosNoSetor($dados_operacao_inventario);
        $total_itensLocalizadosNoSetor = count($lista_itensLocalizadosNoSetor);
       
       }
        /*var_dump($dados_operacao_inventario['cod_local']);    
       echo($dados_operacao_inventario['cod_local']);
       var_dump($dados_operacao_inventario['cod_inventario']);    
       echo($dados_operacao_inventario['cod_inventario']);
       */

       
    if(isset($_GET['excluir']))
    {
        include "../../DAO/OperacaoInventarioDAO.php";

        $OperacaoInventario_dao = new OperacaoInventarioDAO();

        $OperacaoInventario_dao->delete($_GET["cod_operacoes_inventarios"]);
        // var_dump($_GET["cod_local"]);
        header("Location: listar_operacoes.php");
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

//var_dump($dados_operacao_inventario['cod_local']);


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
                        if(isset($dados_operacao_inventario['cod_inventario']))
                        {
                            $selecionado = ($lista_inventarios[$i]->cod_inventario == $dados_operacao_inventario['cod_inventario']) ? "selected" : "";
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

                        if(isset($dados_operacao_inventario['cod_local']))
                        {
                            $selecionado = ($lista_locais[$i]->cod_local == $dados_operacao_inventario['cod_local']) ? "selected" : "";
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
                    <!-- Segundo botão com ação diferente -->
            <button type="submit" formaction="cadastrar_operacao.php?listar=true">Ação Diferente</button>
            </form>

            <h1> Tabela de Itens localizados no setor  </h1>
            <table>
                <thead>
                    <tr>
                        <th>Codigo operação</th>
                        <th>Num. Pat. Item</th>
                        <th>Nome Item</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<$total_itensLocalizadosNoSetor; $i++): ?>
                    <tr>
                        <td> <?= $lista_itensLocalizadosNoSetor[$i]->cod_operacoes_inventarios ?> </td>
                        <td> <?= $lista_itensLocalizadosNoSetor[$i]->numpat_item ?> </td>
                        <td> <?= $lista_itensLocalizadosNoSetor[$i]->nome_item ?> </td>
                    </tr>
                    <?php endfor ?>
                </tbody>
            </table>

            <h1> Tabela de Itens NÃO localizados no setor  </h1>
            <table>
                <thead>
                    <tr>
                        <th>Num. Pat. Item</th>
                        <th>Nome Item</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<$total_itensNaoLocalizadosNoSetor; $i++): ?>
                    <tr>
                        <td> <?= $lista_itensNaoLocalizadosNoSetor[$i]->numpat_item ?> </td>
                        <td> <?= $lista_itensNaoLocalizadosNoSetor[$i]->nome_item ?> </td>
                    </tr>
                    <?php endfor ?>
                </tbody>
            </table>
        </main>

        <?php include '../../includes/rodape.php' ?>
    </body>
</html>
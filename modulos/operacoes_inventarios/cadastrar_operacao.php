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
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Operação de Inventário</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include '../../includes/cabecalho.php' ?>
    <div class="container">

        <div class="row">
        <div class="col">       
         <main>


            <h1 class="mt-4 mb-4">Cadastro de Operação de Inventário</h1>
            <form method="post" action="cadastrar_operacao.php?salvar=true"> 
                <div class="form-group">
                    <label for="cod_inventario">Inventário:</label>
                    <select name="cod_inventario" class="form-control">
                        <option>Selecione o Inventário</option>
                        <?php for($i=0; $i<$total_inventarios; $i++): 
                            $selecionado = (isset($dados_operacao_inventario['cod_inventario']) && $lista_inventarios[$i]->cod_inventario == $dados_operacao_inventario['cod_inventario']) ? "selected" : "";
                        ?>
                        <option value="<?= $lista_inventarios[$i]->cod_inventario ?>" <?= $selecionado ?>>
                            <?= $lista_inventarios[$i]->nome_inventario ?> 
                        </option>
                        <?php endfor ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cod_local">Local:</label>
                    <select name="cod_local" class="form-control">
                        <option>Selecione o Local</option>
                        <?php for($i=0; $i<$total_locais; $i++): 
                            $selecionado = (isset($dados_operacao_inventario['cod_local']) && $lista_locais[$i]->cod_local == $dados_operacao_inventario['cod_local']) ? "selected" : "";
                        ?>
                        <option value="<?= $lista_locais[$i]->cod_local ?>" <?= $selecionado ?>>
                            <?= $lista_locais[$i]->nome_local ?> 
                        </option>
                        <?php endfor ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="numpat_item">Número de Patrimônio do Item:</label>
                    <input name="numpat_item" type="text" class="form-control" value="<?= isset($dados_item) ? $dados_item->numpat_item : NULL ?>"/>
                </div>
                <div class="form-group">
                    <label for="cod_usuario">Usuário Responsável - Código:</label>
                    <input name="cod_usuario" type="text" class="form-control" readonly value="<?= $dados_do_usuario->cod_usuario ?>"/>
                </div>
                <div class="form-group">
                    <label for="nome_usuario">Usuário Responsável - Nome / Username:</label>
                    <input name="nome_usuario" type="text" class="form-control" readonly value="<?= $dados_do_usuario->nome ?> / <?= $dados_do_usuario->username ?>"/>
                </div>
                <button type="submit" class="btn btn-primary">Inserir Operação</button>
                <!-- Segundo botão com ação diferente -->
                <button type="submit" formaction="cadastrar_operacao.php?listar=true" class="btn btn-secondary">Listar Itens</button>
            </form>
        </main>

        </div>

        <div class="col">    

        <h1 class="mt-4 mb-4">Tabela de Itens Localizados no Setor</h1>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Código Operação</th>
                    <th>Número de Patrimônio do Item</th>
                    <th>Nome do Item</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i<$total_itensLocalizadosNoSetor; $i++): ?>
                    <tr>
                        <td><?= $lista_itensLocalizadosNoSetor[$i]->cod_operacoes_inventarios ?></td>
                        <td><?= $lista_itensLocalizadosNoSetor[$i]->numpat_item ?></td>
                        <td><?= $lista_itensLocalizadosNoSetor[$i]->nome_item ?></td>
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
        </div>

        </div>

        <?php include '../../includes/rodape.php' ?>
    </body>
</html>
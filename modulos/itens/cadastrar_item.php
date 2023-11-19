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
            header("Location: lista_itens.php");
       } else {
        
        $item_dao->insert($dados_item);
        var_dump($dados_item);
           echo"Inserido";
           header("Location: lista_itens.php");
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
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Itens</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include '../../includes/cabecalho.php' ?>
    <div class="container">
        <main>
            <h1 class="mt-4 mb-4">Cadastro de Itens</h1>
            <form method="post" action="cadastrar_item.php?salvar=true">
                <div class="form-group">
                    <label for="cod_item">Código do Item:</label>
                    <input name="cod_item" value="<?= isset($dados_item) ? $dados_item->cod_item : NULL ?>" type="text" class="form-control" readonly/>
                </div>
                <div class="form-group">
                    <label for="numpat_item">Número de Patrimônio do Item:</label>
                    <input name="numpat_item" type="number" class="form-control" value="<?= isset($dados_item) ? $dados_item->numpat_item : NULL ?>"/>
                </div>
                <div class="form-group">
                    <label for="nome_item">Nome do Item:</label>
                    <input name="nome_item" type="text" class="form-control" value="<?= isset($dados_item) ? $dados_item->nome_item : NULL ?>"/>
                </div>
                <div class="form-group">
                    <label for="preco_item">Preço:</label>
                    <input name="preco_item" type="number" class="form-control" value="<?= isset($dados_item) ? $dados_item->preco_item : NULL ?>"/>
                </div>
                <div class="form-group">
                    <label for="cod_local">Local:</label>
                    <select name="cod_local" class="form-control">
                        <option>Selecione o Local</option>
                        <?php for($i=0; $i<$total_locais; $i++): 
                            $selecionado = (isset($dados_item->cod_local) && $lista_locais[$i]->cod_local == $dados_item->cod_local) ? "selected" : "";
                        ?>
                        <option value="<?= $lista_locais[$i]->cod_local ?>" <?= $selecionado ?>>
                            <?= $lista_locais[$i]->nome_local ?> 
                        </option>
                        <?php endfor ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </main>
        <?php include '../../includes/rodape.php' ?>
    </div>

    <!-- Adicione o Bootstrap JS e jQuery se necessário -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

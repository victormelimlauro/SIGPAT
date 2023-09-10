<?php 

session_start();

if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");


try {



    /**
     * Obtendo os inventários
     */
    include "../../DAO/InventarioDAO.php";

    $inventario_dao = new InventarioDAO();

    $lista_inventarios = $inventario_dao->getAllRows();

    $total_inventarios = count($lista_inventarios);

    //var_dump($lista_inventarios);
    var_dump($_POST['cod_inventario']);

    if (isset($_POST['opcao'])) {
        $opcao = $_POST['opcao'];

        switch ($opcao) {
            case 'itensLocalCorreto':
                $mensagem = "Você selecionou a Opção 1.";
                break;
            case 'itensLocalDivergente':
                $mensagem = "Você selecionou a Opção 2.";
                break;
            case 'itensNaoLocalizados':
                $mensagem = "Você selecionou a Opção 3.";
                break;
            default:
                $mensagem = "Opção inválida.";
                break;
        }

        echo '<p>' . $mensagem . '</p>';
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

            <form method="post" action="status_itens_inventarios.php"> 
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
            <label> Tipo de relatório:
                <select name="opcao">
                    <option>Selecione o local</option>
                    <option value="itensLocalCorreto">Itens localizados no local correto</option>
                    <option value="itensLocalDivergente">Itens localizados em local divergente</option> 
                    <option value="itensNaoLocalizados">Itens Não localizados</option>

                </select>
            </label>
            
            <button type="submit"> Salvar </button>

            </form>
        </main>

        <?php include '../../includes/rodape.php' ?>
    </body>
</html>
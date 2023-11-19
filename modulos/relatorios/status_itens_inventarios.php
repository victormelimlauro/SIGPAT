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
   //var_dump($_POST['cod_inventario']);

    if (isset($_POST['opcao'])) {
        $opcao = $_POST['opcao'];

        switch ($opcao) {
            case 'itensLocalCorreto':
               // $mensagem = "Você selecionou a Opção 1.";
                include "../../DAO/RelatorioDAO.php";
    
                $Relatorio_dao = new RelatorioDAO();
        
               // $nome_local = $_POST["nome_local"];
        
        
                $dados_relatorio = array (
                'cod_inventario' => $_POST["cod_inventario"],
                );
                
                $lista_relatorio = $Relatorio_dao ->getitensLocalCorreto($dados_relatorio);
                $total_relatorios = count($lista_relatorio);
                // var_dump($lista_relatorio);
                break;
            case 'itensLocalDivergente':
                //$mensagem = "Você selecionou a Opção 2.";
                include "../../DAO/RelatorioDAO.php";
    
                $Relatorio_dao = new RelatorioDAO();
        
               // $nome_local = $_POST["nome_local"];
        
        
                $dados_relatorio = array (
                'cod_inventario' => $_POST["cod_inventario"],
                );
                
                $lista_relatorio = $Relatorio_dao ->itensLocalDivergente($dados_relatorio);
                $total_relatorios = count($lista_relatorio);
                 //var_dump($lista_relatorio);
                break;
            case 'itensNaoLocalizados':
                //$mensagem = "Você selecionou a Opção 3.";
                include "../../DAO/RelatorioDAO.php";
    
                $Relatorio_dao = new RelatorioDAO();
        
               // $nome_local = $_POST["nome_local"];
        
        
                $dados_relatorio = array (
                'cod_inventario' => $_POST["cod_inventario"],
                );
                
                $lista_relatorio = $Relatorio_dao ->itensNaoLocalizados($dados_relatorio);
                $total_relatorios = count($lista_relatorio);
                 //var_dump($lista_relatorio);
                break;
            default:
                $mensagem = "Opção inválida.";
                break;
        }

        // echo '<p>' . $mensagem . '</p>';

    

    var_dump($opcao);
           
    }


} catch(Exception $e) {

    echo $e->getMessage();

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro de produtos - TESTE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        main {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php include '../../includes/cabecalho.php' ?>

<main class="container">
    <h1 class="mb-4">Relatórios de Inventários</h1>
    <form method="post" action="status_itens_inventarios.php">
        <!-- Seu formulário aqui -->
    </form>

    <?php if (isset($opcao)): ?>
        <?php switch ($opcao): ?>
            <?php case 'itensLocalCorreto': ?>
                <h2>Relatório de Itens Localizados no Local Correto</h2>
                <!-- Conteúdo da tabela para 'itensLocalCorreto' -->
                <table class="table">
                    <!-- Seus dados da tabela aqui -->
                </table>
            <?php break; ?>
            <?php case 'itensLocalDivergente': ?>
                <h2>Relatório de Itens Localizados em Local Divergente</h2>
                <!-- Conteúdo da tabela para 'itensLocalDivergente' -->
                <table class="table">
                    <!-- Seus dados da tabela aqui -->
                </table>
            <?php break; ?>
            <?php case 'itensNaoLocalizados': ?>
                <h2>Relatório de Itens Não Localizados</h2>
                <!-- Conteúdo da tabela para 'itensNaoLocalizados' -->
                <table class="table">
                    <!-- Seus dados da tabela aqui -->
                </table>
            <?php break; ?>
            <?php default: ?>
                <p>Opção inválida.</p>
        <?php endswitch; ?>
    <?php endif; ?>
</main>

<?php include '../../includes/rodape.php' ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>


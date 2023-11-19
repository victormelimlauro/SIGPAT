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
        <div class="form-group">
            <label for="cod_inventario">Inventário:</label>
            <select class="form-control" name="cod_inventario" id="cod_inventario">
                <option value="">Selecione o Inventário</option>
                <?php for($i=0; $i<$total_inventarios; $i++): ?>
                    <?php $selecionado = isset($dados_relatorio['cod_inventario']) && $lista_inventarios[$i]->cod_inventario == $dados_relatorio['cod_inventario'] ? "selected" : ""; ?>
                    <option value="<?= $lista_inventarios[$i]->cod_inventario ?>" <?= $selecionado ?>>
                        <?= $lista_inventarios[$i]->nome_inventario ?> 
                    </option>
                <?php endfor ?>
            </select>
        </div>
        <div class="form-group">
            <label for="opcao">Tipo de relatório:</label>
            <select class="form-control" name="opcao" id="opcao">
                <option value="">Selecione o tipo de relatório</option>
                <?php
                $opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";
                $opcoes = array(
                    'itensLocalCorreto' => 'Itens localizados no local correto',
                    'itensLocalDivergente' => 'Itens localizados em local divergente',
                    'itensNaoLocalizados' => 'Itens Não localizados'
                );
                ?>
                <?php foreach ($opcoes as $valor => $descricao): ?>
                    <option value="<?= $valor ?>" <?= $opcao === $valor ? "selected" : "" ?>>
                        <?= $descricao ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Buscar relatório</button>
    </form>

    <?php if (isset($opcao)): ?>
        <!-- Conteúdo específico para cada tipo de relatório -->
        <?php switch ($opcao): ?>
            <?php case 'itensLocalCorreto': ?>
                <h2>Relatório de Itens Localizados no Local Correto</h2>
                <!-- Conteúdo da tabela para 'itensLocalCorreto' -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo Operação</th>
                            <th>Codigo local</th>
                            <th>Nome Local:</th>
                            <th>Num. Plaqueta:</th>
                            <th>Nome item:</th>
                            <th>Cod. Inventario:</th>
                            <th>Nome Inventario:</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=0; $i<$total_relatorios; $i++): ?>
                        <tr>
                            <td><?= $lista_relatorio[$i]->cod_operacoes_inventarios ?></td>
                            <td><?= $lista_relatorio[$i]->cod_local ?></td>
                            <td><?= $lista_relatorio[$i]->nome_local ?></td>
                            <td><?= $lista_relatorio[$i]->numpat_item ?></td>
                            <td><?= $lista_relatorio[$i]->nome_item ?></td>
                            <td><?= $lista_relatorio[$i]->cod_inventario ?></td>
                            <td><?= $lista_relatorio[$i]->nome_inventario ?></td>
                            <td>
                                <a href="cadastrar_local.php?cod_local=<?= $lista_locais[$i]->cod_local ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="cadastrar_local.php?excluir=true&cod_local=<?= $lista_locais[$i]->cod_local ?>" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                        <?php endfor ?>
                    </tbody>
                </table>
                <?php break; ?>
            <?php case 'itensLocalDivergente': ?>
                <h2>Relatório de Itens Localizados em Local Divergente</h2>
                <!-- Conteúdo da tabela para 'itensLocalDivergente' -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo Operação</th>
                            <th>Codigo local encontrado</th>
                            <th>Nome Local encontrado:</th>
                            <th>Codigo local cadastrado</th>
                            <th>Nome Local cadastrado:</th>
                            <th>Num. Plaqueta:</th>
                            <th>Nome item:</th>
                            <th>Cod. Inventario:</th>
                            <th>Nome Inventario:</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=0; $i<$total_relatorios; $i++): ?>
                        <tr>
                            <td><?= $lista_relatorio[$i]->cod_operacoes_inventarios ?></td>
                            <td><?= $lista_relatorio[$i]->cod_local_encontrado ?></td>
                            <td><?= $lista_relatorio[$i]->nome_local_encontrado ?></td>
                            <td><?= $lista_relatorio[$i]->cod_local_cadastrado ?></td>
                            <td><?= $lista_relatorio[$i]->nome_local_cadastrado ?></td>
                            <td><?= $lista_relatorio[$i]->numpat_item ?></td>
                            <td><?= $lista_relatorio[$i]->nome_item ?></td>
                            <td><?= $lista_relatorio[$i]->cod_inventario ?></td>
                            <td><?= $lista_relatorio[$i]->nome_inventario ?></td>
                            <td>
                                <a href="cadastrar_local.php?cod_local=<?= $lista_locais[$i]->cod_local ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="cadastrar_local.php?excluir=true&cod_local=<?= $lista_locais[$i]->cod_local ?>" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                        <?php endfor ?>
                    </tbody>
                </table>
                <?php break; ?>
            <?php case 'itensNaoLocalizados': ?>
                <h2>Relatório de Itens Não Localizados</h2>
                <!-- Conteúdo da tabela para 'itensNaoLocalizados' -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo local</th>
                            <th>Nome Local:</th>
                            <th>Num. Plaqueta:</th>
                            <th>Nome item:</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=0; $i<$total_relatorios; $i++): ?>
                        <tr>
                            <td><?= $lista_relatorio[$i]->cod_local ?></td>
                            <td><?= $lista_relatorio[$i]->nome_local ?></td>
                            <td><?= $lista_relatorio[$i]->numpat_item ?></td>
                            <td><?= $lista_relatorio[$i]->nome_item ?></td>
                            <td>
                                <a href="cadastrar_local.php?cod_local=<?= $lista_locais[$i]->cod_local ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="cadastrar_local.php?excluir=true&cod_local=<?= $lista_locais[$i]->cod_local ?>" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                        <?php endfor ?>
                    </tbody>
                </table>
                <?php break; ?>
            <?php default: ?>
                <!-- Opção inválida -->
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

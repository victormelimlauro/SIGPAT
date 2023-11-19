<?php 

session_start();

if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");


try {

    include "../../DAO/OperacaoInventarioDAO.php";

    $OperacaoInventario_dao = new OperacaoInventarioDAO();

    $lista_OperacaoInventario = $OperacaoInventario_dao->getAllRows();

    $total_itens = count($lista_OperacaoInventario);

   // var_dump($lista_OperacaoInventario);
} catch(Exception $e) {

    echo $e->getMessage();

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Listar Operações</title>
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
    <h1 class="mb-4">Listar Operações</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código Operação</th>
                    <th scope="col">Cod. Local</th>
                    <th scope="col">Nome Local</th>
                    <th scope="col">Num. Pat. Item</th>
                    <th scope="col">Nome Item</th>
                    <th scope="col">Cod. Inventário</th>
                    <th scope="col">Nome Inventário</th>
                    <th scope="col">Cod. Usuário</th>
                    <th scope="col">Nome Usuário</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i<$total_itens; $i++): ?>
                <tr>
                    <td><?= $lista_OperacaoInventario[$i]->cod_operacoes_inventarios ?></td>
                    <td><?= $lista_OperacaoInventario[$i]->cod_local ?></td>
                    <td><?= $lista_OperacaoInventario[$i]->nome_local ?></td>
                    <td><?= $lista_OperacaoInventario[$i]->numpat_item ?></td>
                    <td><?= $lista_OperacaoInventario[$i]->nome_item ?></td>
                    <td><?= $lista_OperacaoInventario[$i]->cod_inventario ?></td>
                    <td><?= $lista_OperacaoInventario[$i]->nome_inventario ?></td>
                    <td><?= $lista_OperacaoInventario[$i]->cod_usuario ?></td>
                    <td><?= $lista_OperacaoInventario[$i]->nome ?></td>
                    <td>
                        <a href="cadastrar_operacao.php?excluir=true&cod_operacoes_inventarios=<?= $lista_OperacaoInventario[$i]->cod_operacoes_inventarios ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
                <?php endfor ?>
            </tbody>
        </table>
    </div>
</main>

<?php include '../../includes/rodape.php' ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<?php 

session_start();

if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");


try {

    include "../../DAO/ItemDAO.php";

    $item_dao = new ItemDAO();

    $lista_itens = $item_dao->getAllRows();

    $total_itens = count($lista_itens);

    //var_dump($lista_itens);
} catch(Exception $e) {

    echo $e->getMessage();

}
?>

<?php include '../../includes/cabecalho.php' ?>

<main class="container">
    <h1 class="mb-4">Listar Produtos</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Código Item</th>
                <th scope="col">Nº Patrimônio</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i<$total_itens; $i++): ?>
            <tr>
                <td><?= $lista_itens[$i]->cod_item ?></td>
                <td><?= $lista_itens[$i]->numpat_item ?></td>
                <td><?= $lista_itens[$i]->nome_item ?></td>
                <td>
                    <a href="cadastrar_item.php?cod_item=<?= $lista_itens[$i]->cod_item ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="cadastrar_item.php?excluir=true&cod_item=<?= $lista_itens[$i]->cod_item ?>" class="btn btn-danger btn-sm">Excluir</a>
                </td>
            </tr>
            <?php endfor ?>
        </tbody>
    </table>

<?php include '../../includes/rodape.php' ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
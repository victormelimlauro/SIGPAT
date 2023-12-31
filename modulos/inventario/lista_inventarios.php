<?php
try {
    include "../../DAO/InventarioDAO.php";

    $inventario_dao = new InventarioDAO();

    $lista_inventarios = $inventario_dao->getAllRows();
    $total_inventarios = count($lista_inventarios);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<?php include '../../includes/cabecalho.php' ?>

<main class="container">
    <h1 class="mb-4">Listar Inventários</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Nome do Inventário</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < $total_inventarios; $i++): ?>
                <tr>
                    <td><?= $lista_inventarios[$i]->cod_inventario ?></td>
                    <td><?= $lista_inventarios[$i]->nome_inventario ?></td>
                    <td>
                        <a href="alterar_inventario.php?cod_inventario=<?= $lista_inventarios[$i]->cod_inventario ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="cadastrar_inventario.php?excluir=true&cod_inventario=<?= $lista_inventarios[$i]->cod_inventario ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endfor ?>
        </tbody>
    </table>
</main>

<!-- <main class="container">
    <h1 class="mb-4">Listar Inventários</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Nome do Inventário</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < $total_inventarios; $i++): ?>
                <tr>
                    <td><?= $lista_inventarios[$i]->cod_inventario ?></td>
                    <td><?= $lista_inventarios[$i]->nome_inventario ?></td>
                    <td>
                        <a href="alterar_inventario.php?cod_inventario=<?= $lista_inventarios[$i]->cod_inventario ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="cadastrar_inventario.php?excluir=true&cod_inventario=<?= $lista_inventarios[$i]->cod_inventario ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endfor ?>
        </tbody>
    </table>
</main> -->

<?php include '../../includes/rodape.php' ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

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

<html>
<head>
    <title>Listar Inventários</title>
</head>
<body>
    <?php include '../../includes/cabecalho.php' ?>
    <main>
        <h1>Listar Inventários</h1>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome do Inventário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < $total_inventarios; $i++): ?>
                    <tr>
                        <td><?= $lista_inventarios[$i]->cod_inventario ?></td>
                        <td><?= $lista_inventarios[$i]->nome_inventario ?></td>
                        <td>
                            <a href="cadastrar_inventario.php?excluir=true&cod_inventario=<?= $lista_inventarios[$i]->cod_inventario ?>">Excluir</a>
                            <a href="alterar_inventario.php?cod_inventario=<?= $lista_inventarios[$i]->cod_inventario ?>">Editar</a> <!-- Link para a página de edição -->
                        </td>
                    </tr>
                <?php endfor ?>
            </tbody>
        </table>
    </main>
    <?php include '../../includes/rodape.php' ?>
</body>
</html>

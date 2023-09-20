<?php
try {
    include "../../DAO/InventarioDAO.php";

    if (isset($_GET['cod_inventario'])) {
        $cod_inventario = $_GET['cod_inventario'];
        $inventario_dao = new InventarioDAO();
        $inventario = $inventario_dao->getById($cod_inventario);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $novo_nome_inventario = $_POST['novo_nome_inventario'];
        $dados_inventario = [
            'cod_inventario' => $cod_inventario,
            'nome_inventario' => $novo_nome_inventario,
        ];
        $inventario_dao->update($dados_inventario);
        header("Location: lista_inventarios.php"); 
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<html>
<head>
    <title>Editar Inventário</title>
</head>
<body>
    <?php include '../../includes/cabecalho.php' ?>
    <main>
        <h1>Editar Inventário</h1>
        <form method="post">
            <label for="cod_inventario">ID do Inventário:</label>
            <input type="text" name="cod_inventario" value="<?= $inventario->cod_inventario ?>" readonly>
            <label for="novo_nome_inventario">Novo Nome do Inventário:</label>
            <input type="text" name="novo_nome_inventario" value="<?= $inventario->nome_inventario ?>">
            <input type="submit" value="Salvar">
        </form>
    </main>
    <?php include '../../includes/rodape.php' ?>
</body>
</html>

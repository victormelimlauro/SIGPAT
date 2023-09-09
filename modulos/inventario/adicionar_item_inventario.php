<?php
session_start();

if (!isset($_SESSION["usuario_logado"])) {
    header("Location: login.php");
}

if (isset($_GET["sair"])) {
    unset($_SESSION["usuario_logado"]);
    header("Location: login.php");
}

try {
    if (isset($_POST['adicionar'])) {


        echo "Item adicionado ao inventário com sucesso!";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<html>
<head>
    <title>Adicionar Item ao Inventário</title>
</head>
<body>
    <?php include '../../includes/cabecalho.php' ?>
    <main>
        <h1>Adicionar Item ao Inventário</h1>
        <form method="post" action="adicionar_item_inventario.php?adicionar=true">
            <label>Nome do Item:</label>
            <input name="nome_item" type="text" required />

            <label>Quantidade:</label>
            <input name="quantidade" type="number" required />

            <label>Selecione o Inventário:</label>
            <select name="cod_inventario">
                <?php
                include "../../DAO/InventarioDAO.php";
                $inventario_dao = new InventarioDAO();
                $lista_inventarios = $inventario_dao->getAllRows();
                foreach ($lista_inventarios as $inventario) {
                    echo "<option value='" . $inventario->cod_inventario . "'>" . $inventario->nome_inventario . "</option>";
                }
                ?>
            </select>

            <button type="submit">Adicionar Item</button>
        </form>
    </main>
    <?php include '../../includes/rodape.php' ?>
</body>
</html>

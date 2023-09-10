<?php
session_start();

if (!isset($_SESSION["usuario_logado"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["sair"])) {
    unset($_SESSION["usuario_logado"]);
    header("Location: login.php");
    exit;
}

try {
    if (isset($_POST['adicionar'])) {
        include "../../DAO/ItemDAO.php";
        $item_dao = new ItemDAO();

        $nome_item = $_POST['nome_item'];
        $quantidade = $_POST['quantidade'];
        $cod_inventario = $_POST['cod_inventario'];

        $dados_item = array(
            'numpat_item' => $quantidade,
            'cod_inventario' => $cod_inventario,
            'nome_item' => $nome_item,
            'preco_item' => $_POST['preco_item']
        );

        // Insira o item no banco de dados
        $item_dao->insert($dados_item);

        echo "Item adicionado ao inventário com sucesso!";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
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

            <label>Preço:</label>
            <input name="preco_item" type="number" required />

            <label>Inventário:</label>
            <select name="cod_inventario">
                <?php
                include "../../DAO/InventarioDAO.php";
                $inventario_dao = new InventarioDAO();
                $lista_inventarios = $inventario_dao->getAllRows();
                if (!empty($lista_inventarios)) {
                    foreach ($lista_inventarios as $inventario) {
                        echo "<option value='" . $inventario->cod_inventario . "'>" . $inventario->nome_inventario . "</option>";
                    }
                } else {
                    echo "<option value='0'>Nenhum inventário encontrado</option>";
                }
                ?>
            </select>

            <button type="submit" name="adicionar">Adicionar Item</button>
        </form>
    </main>
    <?php include '../../includes/rodape.php' ?>
</body>
</html>

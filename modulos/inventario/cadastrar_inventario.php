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
    include "../../DAO/InventarioDAO.php";
    $inventario_dao = new InventarioDAO();


    if (isset($_GET['excluir']) && isset($_GET['cod_inventario'])) {
        $cod_inventario = $_GET['cod_inventario'];
        $inventario_dao->delete($cod_inventario);
        header("Location: lista_inventarios.php");

    }
    
    if (isset($_POST['salvar'])) {
        $dados_inventario = array(
            'nome_inventario' => $_POST["nome_inventario"]
        );

        $inventario_dao->insert($dados_inventario);

        echo "Inventário criado com sucesso!";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<html>
<head>
    <title>Criar Inventário</title>
</head>
<body>
    <?php include '../../includes/cabecalho.php' ?>
    <main>
        <h1>Criar Inventário</h1>
        <form method="post" action="cadastrar_inventario.php?salvar=true">
            <label>Nome do Inventário:</label>
            <input name="nome_inventario" type="text" required />
            <button type="submit" name="salvar">Salvar</button>
        </form>
    </main>
    <?php include '../../includes/rodape.php' ?>
</body>
</html>

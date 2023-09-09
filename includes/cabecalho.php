<?php
if (!isset($_SESSION)) {
    session_start();
}

try {
    $caminho = dirname(__FILE__) . '/../DAO/MySQL.php';
    include_once $caminho;
    $mysql = new Mysql();

    $sql = "SELECT cod_usuario, nome, username FROM usuarios WHERE cod_usuario=:marcador_cod_usuario";
    $stmt = $mysql->prepare($sql);

    $stmt->execute(array('marcador_cod_usuario' => $_SESSION['usuario_logado']));

    $dados_do_usuario = $stmt->fetchObject();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<header>
    <h1>SIGPAT
        <small>Sistema de gestão do patrimônio</small>
    </h1>

    <fieldset>
        <legend>Dados do usuário</legend>
        Bem-vindo <strong><?= $dados_do_usuario->nome ?></strong> (<?= $dados_do_usuario->cod_usuario ?> - <?= $dados_do_usuario->username ?>) à área restrita <a href="index.php?sair=true">Sair</a>
    </fieldset>
    <nav>
        <ul>
            <li><a href="index.php">Tela inicial</a></li>


            <li><a href="modulos/inventario/cadastrar_inventario.php">Criar Inventário</a></li>
            <li><a href="modulos/inventario/lista_inventarios.php">Listar Inventários</a></li>
            <li><a href="modulos/inventario/adicionar_item_inventario.php">Adicionar Item ao Inventário</a></li>

            <li><a href="modulos/local/cadastrar_local.php">Cadastrar Local</a></li>
            <li><a href="modulos/local/listar_locais.php">Listar Locais</a></li>

            <li><a href="#">Cadastrar tipo</a></li>
            <li><a href="#">Listar Tipos</a></li>

            <li><a href="modulos/itens/cadastrar_item.php">Cadastrar ativo</a></li>
            <li><a href="modulos/itens/lista_itens.php">Listar ativos</a></li>
        </ul>
    </nav>
    <hr>
</header>

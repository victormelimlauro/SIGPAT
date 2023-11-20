<?php
if (!isset($_SESSION)) {
    session_start();
}

try {
    $caminho = dirname(__FILE__) . '/../DAO/MySQL.php';
    include_once $caminho;
    $caminho_index = dirname(__FILE__) . '/../index.php';
   
    $mysql = new Mysql();

    $sql = "SELECT cod_usuario, nome, username FROM usuarios WHERE cod_usuario=:marcador_cod_usuario";
    $stmt = $mysql->prepare($sql);

    $stmt->execute(array('marcador_cod_usuario' => $_SESSION['usuario_logado']));

    $dados_do_usuario = $stmt->fetchObject();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu - SIGPAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Define a altura mínima da viewport como 100% da altura da tela */
            margin: 0;
        }

        main {
            flex: 1; /* Faz com que o conteúdo principal ocupe o espaço restante */
        }

        footer {
            background-color: #f8f9fa;
            
            text-align: center;
            position: relative;
            bottom: 0; /* Mantém o rodapé na parte inferior da viewport */
            width: 100%;
        }
    </style>
</head>
<body>
    <main>
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SIGPAT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="https://sigpat.vmserv.com.br/inicio">Inicio</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Inventários
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/modulos/inventario/cadastrar_inventario.php">Cadastrar Inventário</a></li>
                <li><a class="dropdown-item" href="/modulos/inventario/lista_inventarios.php">Listar inventarios</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Locais
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/modulos/locais/cadastrar_local.php">Cadastrar local</a></li>
                <li><a class="dropdown-item" href="/modulos/locais/listar_locais.php">Listar locais</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Itens Patrimônio
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/modulos/itens/cadastrar_item.php">Cadastrar Item</a></li>
                <li><a class="dropdown-item" href="/modulos/itens/lista_itens.php">Listar Itens</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Operação Inventário
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/modulos/operacoes_inventarios/cadastrar_operacao.php">Cadastrar Operação</a></li>
                <li><a class="dropdown-item" href="/modulos/operacoes_inventarios/listar_operacoes.php">Listar Operações</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/modulos/relatorios/status_itens_inventarios.php">Relatório</a>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Tipo Ativo *</a>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Categoria Ativo *</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link disabled dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"  aria-disabled="true" aria-expanded="false">
                    Controle de acesso *
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Usuários</a></li>
                    <li><a class="dropdown-item" href="#">Permissões</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Registros</a></li>
                </ul>
            </li>
        </ul>
   
        <div class="navbar-text ml-auto text-left" style="width:20%">
        <strong>Dados do usuário:</strong>
        <br>
    <span class="mr-2"> <strong><?= $dados_do_usuario->nome ?></strong> (<?= $dados_do_usuario->cod_usuario ?> - <?= $dados_do_usuario->username ?>)</span>
    <br>
    <a href="https://sigpat.vmserv.com.br/index.php?sair=true" class="btn btn-outline-danger">Sair</a>
  </div>

        </div>
    </div>
</nav>


</header>
</html>
